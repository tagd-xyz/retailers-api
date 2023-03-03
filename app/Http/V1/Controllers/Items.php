<?php

namespace App\Http\V1\Controllers;

use App\Http\V1\Requests\Item\Index as IndexRequest;
use App\Http\V1\Requests\Item\Store as StoreRequest;
use App\Http\V1\Resources\Item\Item\Collection as ItemCollection;
use Illuminate\Database\Eloquent\Builder;
use Tagd\Core\Models\Item\Item;
use Tagd\Core\Repositories\Interfaces\Items\Items as ItemsRepo;
use App\Http\V1\Resources\Item\Item\Single as ItemSingle;
use Illuminate\Http\Request;

class Items extends Controller
{
    /**
     * Get basic status info
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function index(
        ItemsRepo $itemsRepo,
        IndexRequest $request
    ) {
        $actingAs = $this->actingAs($request);

        $this->authorize(
            'index',
            [Item::class, $actingAs]
        );

        $items = $itemsRepo->allPaginated([
            'perPage' => $request->get(IndexRequest::PER_PAGE, 25),
            'page' => $request->get(IndexRequest::PAGE, 1),
            'orderBy' => 'created_at',
            'direction' => $request->get(IndexRequest::DIRECTION, 'asc'),
            'relations' => [
                'retailer',
                'tagds',
                'tagds.consumer',
                'tagds.reseller',
            ],
            'filterFunc' => function ($query) use ($actingAs) {
                $query->whereHas('tagds', function (Builder $builder) use ($actingAs) {
                    $builder->where('retailer_id', $actingAs->id);
                });
            },
        ]);

        return response()->withData(
            new ItemCollection($items)
        );
    }

    public function store(
        ItemsRepo $itemsRepo,
        StoreRequest $request
    ) {
        $actingAs = $this->actingAs($request);

        $this->authorize(
            'store',
            [Item::class, $actingAs]
        );

        $item = $itemsRepo
            ->createForConsumer(
                $request->get(StoreRequest::CONSUMER),
                $request->get(StoreRequest::TRANSACTION, ''),
                $actingAs->id,
                [
                    'name' => $request->get(StoreRequest::NAME, 'Unknown'),
                    'description' => $request->get(StoreRequest::DESCRIPTION, 'Unknown'),
                    'type' => $request->get(StoreRequest::TYPE, 'Unknown'),
                    'properties' => $request->get(StoreRequest::PROPERTIES, []),
                ]
            );

        return response()->withData(
            new ItemSingle($item)
        );
    }

    public function show(
        Request $request,
        ItemsRepo $itemsRepo,
        string $itemId
    ) {
        $item = $itemsRepo->findById($itemId, [
            'relations' => [
                'retailer',
                'tagds',
                'tagds.consumer',
                'tagds.reseller',
            ],
        ]);

        $this->authorize(
            'show',
            [$item, $this->actingAs($request)]
        );

        return response()->withData(
            new ItemSingle($item)
        );
    }

    public function destroy(
        Request $request,
        ItemsRepo $itemsRepo,
        string $itemId
    ) {
        $item = $itemsRepo->deleteById($itemId);

        $this->authorize(
            'destroy', [$item, $this->actingAs($request)]
        );

        return response()->withData([]);
    }
}
