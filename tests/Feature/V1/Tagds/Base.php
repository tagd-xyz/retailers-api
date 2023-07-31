<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Tagds;

use Tagd\Core\Tests\Traits\NeedsDatabase;
use Tagd\Core\Tests\Traits\NeedsRetailers;
use Tagd\Core\Tests\Traits\NeedsTagds;

abstract class Base extends \Tests\Feature\V1\Base
{
    use NeedsDatabase, NeedsRetailers, NeedsTagds;
}
