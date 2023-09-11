<?php

namespace Tests\Command;

use Tagd\Core\Database\Seeders\Traits\UsesFactories;
use Tagd\Core\Tests\Traits\NeedsDatabase;
use Tagd\Core\Tests\Traits\NeedsRetailers;
use Tests\TestCase;

abstract class Base extends TestCase
{
    use NeedsDatabase, NeedsRetailers, UsesFactories;

    /**
     * setUp any test
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setupFactories();
    }
}
