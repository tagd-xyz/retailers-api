<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Ref\ItemTypes;

use Tests\Feature\V1\Ref\Base;

class GetTest extends Base
{
    /**
     * GET /ref/item-types
     *
     * @return void
     */
    public function test_ref_items_types_get_request()
    {
        $retailer = $this->aRetailer();

        $response = $this
            ->actingAsARetailer($retailer)
            ->get(static::URL_REF_ITEM_TYPES)
            ->assertStatus(200);
    }

    public function test_ref_items_types_get_no_auth_request()
    {
        // $retailer = $this->aRetailer();

        $response = $this
            ->get(static::URL_REF_ITEM_TYPES)
            ->assertStatus(403);
    }
}
