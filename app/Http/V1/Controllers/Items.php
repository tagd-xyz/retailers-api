<?php

namespace App\Http\V1\Controllers;

use App\Http\V1\Requests\Item\Store as StoreRequest;
use App\Http\V1\Resources\Item\Item\Single as ItemSingle;
use Illuminate\Http\Request;
use Tagd\Core\Models\Item\Item;
use Tagd\Core\Repositories\Interfaces\Items\Items as ItemsRepo;

class Items extends Controller
{
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

        return response()->withData([]);
    }
}
