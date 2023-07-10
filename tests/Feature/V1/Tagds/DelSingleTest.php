<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Tagds;

class DelSingleTest extends Base
{
    /**
     * DEL /tagds/{tagd}
     *
     * @return void
     */
    public function test_tagd_del_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->delete(static::URL_TAGDS . '/' . $tagd->id)
            ->assertStatus(204);
    }

    /**
     * DEL /tagds/{tagd}
     *
     * @return void
     */
    public function test_tagd_del_not_auth_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->delete(static::URL_TAGDS . '/' . $tagd->id)
            ->assertStatus(403);
    }

    /**
     * DEL /tagds/{tagd}
     *
     * @return void
     */
    public function test_tagd_del_not_found_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->delete(static::URL_TAGDS . '/' . '123')
            ->assertStatus(404);
    }

    /**
     * DEL /tagds/{tagd}
     *
     * @return void
     */
    public function test_tagd_del_not_allowed_request()
    {
        $retailer = $this->aRetailer();

        $tagd = $this->aTagd([
            // 'retailer' => $retailer,
        ]);

        $response = $this
            ->actingAsARetailer($retailer)
            ->delete(static::URL_TAGDS . '/' . $tagd->id)
            ->assertStatus(403);
    }
}
