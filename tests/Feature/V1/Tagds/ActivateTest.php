<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Tagds;

class ActivateTest extends Base
{
    /**
     * POST /tagds/{tagd}/activate
     *
     * @return void
     */
    public function test_tagd_post_activate_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_TAGDS . '/' . $tagd->id . '/activate')
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'slug',
                ],
            ])
            ->assertJsonPath('data.status', 'active');
    }

    /**
     * POST /tagds/{tagd}/activate
     *
     * @return void
     */
    public function test_tagd_post_activate_not_auth_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->post(static::URL_TAGDS . '/' . $tagd->id . '/activate')
            ->assertStatus(403);
    }

    /**
     * POST /tagds/{tagd}/activate
     *
     * @return void
     */
    public function test_tagd_post_activate_not_found_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_TAGDS . '/' . '123' . '/activate')
            ->assertStatus(404);
    }

    /**
     * POST /tagds/{tagd}/activate
     *
     * @return void
     */
    public function test_tagd_post_activate_not_allowed_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            // 'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_TAGDS . '/' . $tagd->id . '/activate')
            ->assertStatus(403);
    }
}
