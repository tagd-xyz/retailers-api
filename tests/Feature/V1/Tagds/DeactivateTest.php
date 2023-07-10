<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Tagds;

class DeactivateTest extends Base
{
    /**
     * POST /tagds/{tagd}/deactivate
     *
     * @return void
     */
    public function test_tagd_post_deactivate_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_TAGDS . '/' . $tagd->id . '/deactivate')
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'slug',
                ],
            ])
            ->assertJsonPath('data.status', 'inactive');
    }

    /**
     * POST /tagds/{tagd}/deactivate
     *
     * @return void
     */
    public function test_tagd_post_deactivate_not_auth_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->post(static::URL_TAGDS . '/' . $tagd->id . '/deactivate')
            ->assertStatus(403);
    }

    /**
     * POST /tagds/{tagd}/deactivate
     *
     * @return void
     */
    public function test_tagd_post_deactivate_not_found_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_TAGDS . '/' . '123' . '/deactivate')
            ->assertStatus(404);
    }

    /**
     * POST /tagds/{tagd}/deactivate
     *
     * @return void
     */
    public function test_tagd_post_deactivate_not_allowed_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            // 'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_TAGDS . '/' . $tagd->id . '/deactivate')
            ->assertStatus(403);
    }

    /**
     * POST /tagds/{tagd}/deactivate
     *
     * @return void
     */
    public function test_tagd_post_deactivate_not_allowed_with_children_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $children = $this->aTagdChildOf($tagd);

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_TAGDS . '/' . $tagd->id . '/deactivate')
            ->assertStatus(403);
    }
}
