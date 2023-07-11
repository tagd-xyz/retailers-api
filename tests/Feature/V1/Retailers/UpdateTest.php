<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Retailers;

class UpdateTest extends Base
{
    /**
     * PUT /retailers/{retailer}
     *
     * @return void
     */
    public function test_retailers_put_request()
    {
        $retailer = $this->aRetailer();

        $response = $this
            ->actingAsARetailer($retailer)
            ->put(static::URL_RETAILERS . '/' . $retailer->id, [
                'name' => 'Test Retailer',
            ])
            ->assertStatus(200)
            ->assertJsonPath('data.name', 'Test Retailer');
    }

    /**
     * PUT /retailers/{retailer}
     *
     * @return void
     */
    public function test_retailers_put_not_auth_request()
    {
        $retailer = $this->aRetailer();

        $response = $this
            // ->actingAsARetailer($retailer)
            ->put(static::URL_RETAILERS . '/' . $retailer->id, [
                'name' => 'Test Retailer',
            ])
            ->assertStatus(403);
    }

    /**
     * PUT /retailers/{retailer}
     *
     * @return void
     */
    public function test_retailers_put_not_found_request()
    {
        $retailer = $this->aRetailer();

        $response = $this
            ->actingAsARetailer($retailer)
            ->put(static::URL_RETAILERS . '/' . '123', [
                'name' => 'Test Retailer',
            ])
            ->assertStatus(404);
    }

    /**
     * PUT /retailers/{retailer}
     *
     * @return void
     */
    public function test_retailers_put_missing_name_request()
    {
        $retailer = $this->aRetailer();

        $response = $this
            ->actingAsARetailer($retailer)
            ->put(static::URL_RETAILERS . '/' . $retailer->id, [
                // 'name' => 'Test Retailer',
            ])
            ->assertStatus(422)
            ->assertJsonPath('error.details.name.0', 'The name field is required.');
    }
}
