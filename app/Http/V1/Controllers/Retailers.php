<?php

namespace App\Http\V1\Controllers;

use App\Http\V1\Requests\Retailer\Update as UpdateRequest;
use App\Http\V1\Resources\Actor\Retailer\Single as RetailerSingle;
use Tagd\Core\Repositories\Interfaces\Actors\Retailers as RetailersRepo;

class Retailers extends Controller
{
    public function update(
        UpdateRequest $request,
        RetailersRepo $retailersRepo,
        string $retailerId
    ) {
        $retailer = $retailersRepo->findById($retailerId);

        $this->authorize(
            'update',
            [$retailer, $this->actingAs($request)]
        );

        $retailer = $retailersRepo->update($retailerId, [
            'name' => $request->get(UpdateRequest::NAME),
        ]);

        return response()->withData(
            new RetailerSingle($retailer)
        );
    }
}
