<?php

namespace Tests\Feature\V1;

use Tagd\Core\Database\Seeders\Traits\UsesFactories;
use Tests\TestCase;

abstract class Base extends TestCase
{
    use UsesFactories;

    public const URL_V1 = '/api/v1';

    public const URL_STATUS = '/api/v1/status';

    public const URL_ME = '/api/v1/me';

    public const URL_ITEMS = '/api/v1/items';

    public const URL_RETAILERS = '/api/v1/retailers';

    public const URL_STOCK = '/api/v1/stock';

    public const URL_TAGDS = '/api/v1/tagds';

    public const URL_REF_ITEM_TYPES = '/api/v1/ref/item-types';

    public const URL_REF_CURRENCIES = '/api/v1/ref/currencies';

    /**
     * setUp any test
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'Accept' => 'application/json',
        ]);

        $this->setupFactories();
    }
}
