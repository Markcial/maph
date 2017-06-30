<?php

namespace Maph\Tests\Stubs;

use Maph\Destructure;

class DestructureTypedStub
{
    use Destructure;

    public $first;
    public $second;

    public function __construct(\stdClass $first, int $second)
    {
        $this->first = $first;
        $this->second = $second;
    }
}
