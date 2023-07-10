<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Tagds;

class GetSingleTest extends Base
{
    /**
     * GET /tagds/{tagd}
     *
     * @return void
     */
    public function test_tagd_get_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->get(static::URL_TAGDS . '/' . $tagd->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'slug',
                ],
            ])
            ->assertJsonPath('data.id', $tagd->id);
    }

    /**
     * GET /tagds/{tagd}
     *
     * @return void
     */
    public function test_tagd_get_not_auth_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->get(static::URL_TAGDS . '/' . $tagd->id)
            ->assertStatus(403);
    }

    /**
     * GET /tagds/{tagd}
     *
     * @return void
     */
    public function test_tagd_get_not_found_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->get(static::URL_TAGDS . '/' . '123')
            ->assertStatus(404);
    }

    /**
     * GET /tagds/{tagd}
     *
     * @return void
     */
    public function test_tagd_get_not_allowed_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            // 'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->get(static::URL_TAGDS . '/' . $tagd->id)
            ->assertStatus(403);
    }
}
