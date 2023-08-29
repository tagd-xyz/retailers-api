<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Tagds;

class ReturnTest extends Base
{
    /**
     * POST /tagds/{tagd}/return
     *
     * @return void
     */
    public function test_tagd_post_return_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_TAGDS . '/' . $tagd->id . '/return')
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'slug',
                ],
            ])
            ->assertJsonPath('data.status', 'returned');
    }

    /**
     * POST /tagds/{tagd}/return
     *
     * @return void
     */
    public function test_tagd_post_return_not_auth_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->post(static::URL_TAGDS . '/' . $tagd->id . '/return')
            ->assertStatus(403);
    }

    /**
     * POST /tagds/{tagd}/return
     *
     * @return void
     */
    public function test_tagd_post_return_not_found_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_TAGDS . '/' . '123' . '/return')
            ->assertStatus(404);
    }

    /**
     * POST /tagds/{tagd}/return
     *
     * @return void
     */
    public function test_tagd_post_return_not_allowed_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            // 'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_TAGDS . '/' . $tagd->id . '/return')
            ->assertStatus(403);
    }
}
