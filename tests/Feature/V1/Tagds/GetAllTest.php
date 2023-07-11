<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Tagds;

class GetAllTest extends Base
{
    /**
     * GET /tagds
     *
     * @return void
     */
    public function test_tagds_get_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->get(static::URL_TAGDS)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    '*' => [
                        'id',
                        'slug',
                    ],
                ],
            ]);
    }
}
