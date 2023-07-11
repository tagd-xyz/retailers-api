<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\Command;

use Tests\Command\Base;

class SeedTest extends Base
{
    /**
     * stock:seed
     *
     * @return void
     */
    public function test_stock_seed()
    {
        $retailer = $this->aRetailer();

        $this->artisan('stock:seed ' . $retailer->email)
            ->expectsQuestion('What type of stock?', 'FASHION')
            ->expectsQuestion('How many?', '1')
            ->assertSuccessful();
    }
}
