<?php

namespace App\Http\V1\Controllers;

use App\Http\V1\Requests\Tagd\Index as IndexRequest;
use App\Http\V1\Resources\Item\Tagd\Collection as TagdCollection;
use App\Http\V1\Resources\Item\Tagd\Single as TagdSingle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Tagd\Core\Models\Item\Tagd as TagdModel;
use Tagd\Core\Repositories\Interfaces\Items\Tagds as TagdsRepo;

class Tagds extends Controller
{
    /**
     * Get basic status info
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index(
        TagdsRepo $tagdsRepo,
        IndexRequest $request
    ) {
        $actingAs = $this->actingAs($request);

        $this->authorize(
            'index',
            [TagdModel::class, $actingAs]
        );

        $tagds = $tagdsRepo->allPaginated([
            'perPage' => $request->get(IndexRequest::PER_PAGE, 100),
            'page' => $request->get(IndexRequest::PAGE, 1),
            'orderBy' => 'created_at',
            'direction' => $request->get(IndexRequest::DIRECTION, 'asc'),
            'relations' => [
                'item',
                'item.retailer',
                'consumer',
                'reseller',
                'item.images',
                'item.images.upload',
            ],
            'filterFunc' => function ($query) use ($actingAs) {
                $query
                    ->whereHas('item', function (Builder $query) use ($actingAs) {
                        $query->where('retailer_id', $actingAs->id);
                    });
            },
        ]);

        return response()->withData(
            new TagdCollection($tagds)
        );
    }

    public function destroy(
        Request $request,
        TagdsRepo $tagdsRepo,
        string $tagdId
    ) {
        $tagd = $this->fetchTagdById($tagdsRepo, $tagdId);

        $this->authorize(
            'destroy',
            [$tagd, $this->actingAs($request)]
        );

        // TODO: check pre-condition for deletion

        $tagdsRepo->deleteById($tagdId);

        return response()->withData([], 204);
    }

    public function show(
        Request $request,
        TagdsRepo $tagdsRepo,
        string $tagdId
    ) {
        $tagd = $this->fetchTagdById($tagdsRepo, $tagdId);

        $this->authorize(
            'show',
            [$tagd, $this->actingAs($request)]
        );

        return response()->withData(
            new TagdSingle($tagd)
        );
    }

    public function activate(
        Request $request,
        TagdsRepo $tagdsRepo,
        string $tagdId
    ) {
        $tagd = $this->fetchTagdById($tagdsRepo, $tagdId);

        $this->authorize(
            'activate',
            [$tagd, $this->actingAs($request)]
        );

        $tagd->activate();

        return response()->withData(
            new TagdSingle($tagd)
        );
    }

    public function deactivate(
        Request $request,
        TagdsRepo $tagdsRepo,
        string $tagdId
    ) {
        $tagd = $this->fetchTagdById($tagdsRepo, $tagdId);

        $this->authorize(
            'deactivate',
            [$tagd, $this->actingAs($request)]
        );

        $tagd->deactivate();

        return response()->withData(
            new TagdSingle($tagd)
        );
    }

    private function fetchTagdById(
        TagdsRepo $tagdsRepo,
        string $tagdId
    ): ?TagdModel {
        return $tagdsRepo->findById($tagdId, [
            'relations' => [
                'item',
                'item.retailer',
                'item.images',
                'item.images.upload',
                'consumer',
                'reseller',
            ],
        ]);
    }
}
