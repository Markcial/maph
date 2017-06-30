<?php

namespace Maph\Tests\Stubs;

use Maph\SelfWire as WireIt;

class SelfWireNestedLevelStub
{
    use WireIt;

    private $stub;

    public function __construct(SelfWireOneLevelStub $stub)
    {
        $this->stub = $stub;
    }
}
