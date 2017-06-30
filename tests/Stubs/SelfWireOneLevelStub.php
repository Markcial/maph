<?php

namespace Maph\Tests\Stubs;

use Maph\SelfWire as WireIt;

class SelfWireOneLevelStub
{
    use WireIt;

    private $stub;

    public function __construct(SelfWireStubSimple $stub)
    {
        $this->stub = $stub;
    }
}
