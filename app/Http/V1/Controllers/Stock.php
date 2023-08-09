<?php

namespace App\Http\V1\Controllers;

use App\Http\V1\Requests\Stock\Index as IndexRequest;
use App\Http\V1\Requests\Stock\Store as StoreRequest;
use App\Http\V1\Requests\Stock\Update as UpdateRequest;
use App\Http\V1\Resources\Item\Stock\Collection as StockCollection;
use App\Http\V1\Resources\Item\Stock\Single as StockSingle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Tagd\Core\Models\Item\Stock as StockModel;
use Tagd\Core\Repositories\Interfaces\Items\Stock as StockRepo;

class Stock extends Controller
{
    /**
     * Get basic status info
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index(
        StockRepo $stockRepo,
        IndexRequest $request
    ) {
        $actingAs = $this->actingAs($request);

        $this->authorize(
            'index',
            [StockModel::class, $actingAs]
        );

        $stock = $stockRepo->allPaginated([
            'perPage' => $request->get(IndexRequest::PER_PAGE, 100),
            'page' => $request->get(IndexRequest::PAGE, 1),
            'orderBy' => 'created_at',
            'direction' => $request->get(IndexRequest::DIRECTION, 'asc'),
            'relations' => [
                'retailer',
                'images',
                'images.upload',
            ],
            'filterFunc' => function ($query) use ($actingAs) {
                $query
                    ->whereHas('retailer', function (Builder $query) use ($actingAs) {
                        $query->where('id', $actingAs->id);
                    });
            },
        ]);

        return response()->withData(
            new StockCollection($stock)
        );
    }

    public function show(
        Request $request,
        StockRepo $stockRepo,
        string $stockId
    ) {
        $stock = $stockRepo->findById($stockId, [
            'relations' => [
                'retailer',
                'images',
                'images.upload',
            ],
        ]);

        $this->authorize(
            'show',
            [$stock, $this->actingAs($request)]
        );

        return response()->withData(
            new StockSingle($stock)
        );
    }

    public function store(
        StockRepo $stockRepo,
        StoreRequest $request
    ) {
        $actingAs = $this->actingAs($request);

        $this->authorize(
            'store',
            [StockModel::class, $actingAs]
        );

        $stock = $stockRepo
            ->create([
                'retailer_id' => $actingAs->id,
                'name' => $request->get(StoreRequest::NAME, 'Unknown'),
                'description' => $request->get(StoreRequest::DESCRIPTION, 'Unknown'),
                'type_id' => $request->get(StoreRequest::TYPE, 'Unknown'),
                'properties' => $request->get(StoreRequest::PROPERTIES, []),
            ]);

        return response()->withData(
            new StockSingle($stock),
            201
        );
    }

    public function update(
        UpdateRequest $request,
        string $stockId,
        StockRepo $stockRepo
    ) {
        $stock = $stockRepo->findById($stockId);

        $this->authorize(
            'update',
            [$stock, $this->actingAs($request)]
        );

        $stock = $stockRepo->updateImages(
            $stockId,
            $request->get(UpdateRequest::IMAGE_UPLOADS)
        );

        return response()->withData(
            new StockSingle($stock)
        );
    }

    public function destroy(
        Request $request,
        StockRepo $stockRepo,
        string $stockId
    ) {
        $item = $stockRepo->findById($stockId);

        $this->authorize(
            'destroy', [$item, $this->actingAs($request)]
        );

        $stockRepo->deleteById($stockId);

        return response()->withData([], 204);
    }
}
