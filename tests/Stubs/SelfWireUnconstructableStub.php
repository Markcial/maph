<?php

namespace Maph\Tests\Stubs;

use Maph\SelfWire as WireIt;

class SelfWireUnconstructableStub
{
    use WireIt;

    private $stub;
    private $text;

    public function __construct(SelfWireStubSimple $stub, string $text)
    {
        $this->stub = $stub;
        $this->text = $text;
    }
}
