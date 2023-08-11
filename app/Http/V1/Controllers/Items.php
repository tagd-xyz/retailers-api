<?php

namespace App\Http\V1\Controllers;

use App\Http\V1\Requests\Item\Store as StoreRequest;
use App\Http\V1\Resources\Item\Item\Single as ItemSingle;
use Illuminate\Http\Request;
use Tagd\Core\Models\Item\Item;
use Tagd\Core\Repositories\Interfaces\Items\Items as ItemsRepo;
use Tagd\Core\Services\Interfaces\RetailerSales;

class Items extends Controller
{
    public function store(
        RetailerSales $retailerSales,
        StoreRequest $request
    ) {
        $actingAs = $this->actingAs($request);

        $this->authorize(
            'store',
            [Item::class, $actingAs]
        );

        $item = $retailerSales->processRetailerSale(
            $actingAs->id,
            $request->get(StoreRequest::CONSUMER),
            $request->get(StoreRequest::TRANSACTION, ''),
            $request->get(StoreRequest::PRICE, ''),
            $request->get(StoreRequest::LOCATION, ''),
            [
                'name' => $request->get(StoreRequest::NAME, 'Unknown'),
                'description' => $request->get(StoreRequest::DESCRIPTION, 'Unknown'),
                'type' => $request->get(StoreRequest::TYPE, 'Unknown'),
                'properties' => $request->get(StoreRequest::PROPERTIES, []),
            ],
            $request->get(StoreRequest::IMAGE_UPLOADS, [])
        );

        return response()->withData(
            new ItemSingle($item),
            201
        );
    }

    public function destroy(
        Request $request,
        ItemsRepo $itemsRepo,
        string $itemId
    ) {
        $item = $itemsRepo->findById($itemId);

        $this->authorize(
            'destroy', [$item, $this->actingAs($request)]
        );

        $itemsRepo->deleteById($itemId);

        return response()->withData([], 204);
    }
}
