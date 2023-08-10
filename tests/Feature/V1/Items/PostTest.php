<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Items;

class PostTest extends Base
{
    /**
     * POST /items
     *
     * @return void
     */
    public function test_items_post_request()
    {
        $retailer = $this->aRetailer();

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_ITEMS, [
                'name' => 'Test Item',
                'description' => 'Test Item Description',
                'type' => 'fashion',
                'properties' => [],
                'consumer' => 'consumer@gmail.com',
                'transaction' => '1234567890',
                'price' => [
                    'amount' => 100,
                    'currency' => 'USD',
                ],
            ])
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'name',
                    'type',
                    'retailer',
                    'description',
                    'properties',
                ],
            ]);
    }

    public function test_items_post_not_auth_request()
    {
        $retailer = $this->aRetailer();

        $response = $this
            ->post(static::URL_ITEMS, [
                'name' => 'Test Item',
                'description' => 'Test Item Description',
                'type' => 'fashion',
                'properties' => [],
                'consumer' => 'consumer@gmail.com',
                'transaction' => '1234567890',
                'price' => [
                    'amount' => 100,
                    'currency' => 'USD',
                ],
            ])
            ->assertStatus(403);
    }

    public function test_items_post_missing_consumer_request()
    {
        $retailer = $this->aRetailer();

        $response = $this
            ->actingAsARetailer($retailer)
            ->post(static::URL_ITEMS, [
                'name' => 'Test Item',
                'description' => 'Test Item Description',
                'type' => 'fashion',
                'properties' => [],
                // 'consumer' => 'consumer@gmail.com',
                'transaction' => '1234567890',
                'price' => [
                    'amount' => 100,
                    'currency' => 'USD',
                ],
            ])
            ->assertStatus(422)
            ->assertJsonPath('error.details.consumer.0', 'The consumer field is required.');
    }
}
