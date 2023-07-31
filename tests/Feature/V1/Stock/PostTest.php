<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Stock;

class PostTest extends Base
{
    /**
     * POST /stock
     *
     * @return void
     */
    public function test_stock_post_request()
    {
        $retailer = $this->aRetailer();

        $stock = $this->aStock([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_STOCK, [
                'name' => 'Test Stock',
                'description' => 'Test Stock Description',
                'type' => 'fashion',
                'properties' => [],
            ])
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'name',
                    'description',
                    'properties',
                ],
            ]);
    }

    /**
     * POST /stock
     *
     * @return void
     */
    public function test_stock_post_not_auth_request()
    {
        $retailer = $this->aRetailer();

        $stock = $this->aStock([
            'retailer' => $retailer,
        ]);

        $response = $this
            // ->actingAsARetailer($retailer)
            ->post(static::URL_STOCK, [
                'name' => 'Test Stock',
                'description' => 'Test Stock Description',
                'type' => 'fashion',
                'properties' => [],
            ])
            ->assertStatus(403);
    }

    /**
     * POST /stock
     *
     * @return void
     */
    public function test_stock_post_missing_name_request()
    {
        $retailer = $this->aRetailer();

        $stock = $this->aStock([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_STOCK, [
                // 'name' => 'Test Stock',
                'description' => 'Test Stock Description',
                'type' => 'fashion',
                'properties' => [],
            ])
            ->assertStatus(422);
    }
}
