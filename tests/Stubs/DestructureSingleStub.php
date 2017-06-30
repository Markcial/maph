<?php

namespace Maph\Tests\Stubs;

use Maph\Destructure;

class DestructureSingleStub
{
    use Destructure;

    public $one;

    public function __construct($one)
    {
        $this->one = $one;
    }
}
