<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Stock;

class GetAllTest extends Base
{
    /**
     * GET /stock
     *
     * @return void
     */
    public function test_stock_all_get_request()
    {
        $retailer = $this->aRetailer();

        $stock = $this->aStock([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->get(static::URL_STOCK)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    '*' => [
                        'id',
                    ],
                ],
            ]);
    }

    /**
     * GET /stock
     *
     * @return void
     */
    public function test_stock_all_get_not_auth_request()
    {
        $retailer = $this->aRetailer();

        $stock = $this->aStock([
            'retailer' => $retailer,
        ]);

        $response = $this
            // ->actingAsARetailer($retailer)
            ->get(static::URL_STOCK)
            ->assertStatus(403);
    }
}
