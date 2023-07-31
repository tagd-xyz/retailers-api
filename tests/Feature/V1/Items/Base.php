<?php

//phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps

namespace Tests\Feature\V1\Items;

use Tagd\Core\Tests\Traits\NeedsDatabase;
use Tagd\Core\Tests\Traits\NeedsItems;
use Tagd\Core\Tests\Traits\NeedsRetailers;

abstract class Base extends \Tests\Feature\V1\Base
{
    use NeedsDatabase, NeedsRetailers, NeedsItems;
}
