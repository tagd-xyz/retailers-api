<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Items;

class DelTest extends Base
{
    /**
     * DEL /items/{item}
     *
     * @return void
     */
    public function test_items_del_request()
    {
        $retailer = $this->aRetailer();

        $item = $this->anItem([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->delete(static::URL_ITEMS . '/' . $item->id)
            ->assertStatus(204);
    }

    /**
     * DEL /items/{item}
     *
     * @return void
     */
    public function test_items_del_not_auth_request()
    {
        $retailer = $this->aRetailer();

        $item = $this->anItem([
            'retailer' => $retailer,
        ]);

        $response = $this
            // ->actingAsARetailer($retailer)
            ->delete(static::URL_ITEMS . '/' . $item->id)
            ->assertStatus(403);
    }

    /**
     * DEL /items/{item}
     *
     * @return void
     */
    public function test_items_del_not_found_request()
    {
        $retailer = $this->aRetailer();

        $response = $this
            ->actingAsARetailer($retailer)
            ->delete(static::URL_ITEMS . '/' . '1234')
            ->assertStatus(404);
    }
}
