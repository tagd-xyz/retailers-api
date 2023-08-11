<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Ref\Countries;

use Tests\Feature\V1\Ref\Base;

class GetTest extends Base
{
    /**
     * GET /ref/countries
     *
     * @return void
     */
    public function test_ref_countries_get_request()
    {
        $retailer = $this->aRetailer();

        $response = $this
            ->actingAsARetailer($retailer)
            ->get(static::URL_REF_COUNTRIES)
            ->assertStatus(200);
    }

    public function test_ref_countries_get_no_auth_request()
    {
        // $retailer = $this->aRetailer();

        $response = $this
            ->get(static::URL_REF_COUNTRIES)
            ->assertStatus(403);
    }
}
