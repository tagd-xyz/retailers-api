<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Stock;

class GetTest extends Base
{
    /**
     * GET /stock/{stock}
     *
     * @return void
     */
    public function test_stock_get_request()
    {
        $retailer = $this->aRetailer();

        $stock = $this->aStock([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->get(static::URL_STOCK . '/' . $stock->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                ],
            ]);
    }

    /**
     * GET /stock/{stock}
     *
     * @return void
     */
    public function test_stock_get_not_auth_request()
    {
        $retailer = $this->aRetailer();

        $stock = $this->aStock([
            'retailer' => $retailer,
        ]);

        $response = $this
            // ->actingAsARetailer($retailer)
            ->get(static::URL_STOCK . '/' . $stock->id)
            ->assertStatus(403);
    }

    /**
     * GET /stock/{stock}
     *
     * @return void
     */
    public function test_stock_get_not_found_request()
    {
        $retailer = $this->aRetailer();

        $stock = $this->aStock([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->get(static::URL_STOCK . '/' . '123')
            ->assertStatus(404);
    }
}
