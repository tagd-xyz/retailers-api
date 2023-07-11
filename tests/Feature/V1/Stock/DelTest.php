<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Stock;

class DelTest extends Base
{
    /**
     * DEL /stock/{stock}
     *
     * @return void
     */
    public function test_stock_del_request()
    {
        $retailer = $this->aRetailer();

        $stock = $this->aStock([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->delete(static::URL_STOCK . '/' . $stock->id)
            ->assertStatus(204);
    }

    /**
     * DEL /stock/{stock}
     *
     * @return void
     */
    public function test_stock_del_not_auth_request()
    {
        $retailer = $this->aRetailer();

        $stock = $this->aStock([
            'retailer' => $retailer,
        ]);

        $response = $this
            // ->actingAsARetailer($retailer)
            ->delete(static::URL_STOCK . '/' . $stock->id)
            ->assertStatus(403);
    }

    /**
     * DEL /stock/{stock}
     *
     * @return void
     */
    public function test_stock_del_not_found_request()
    {
        $retailer = $this->aRetailer();

        $stock = $this->aStock([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->delete(static::URL_STOCK . '/' . '123')
            ->assertStatus(404);
    }
}
