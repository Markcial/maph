<?php

namespace Maph\Tests;

use PHPUnit\Framework\TestCase;
use Maph\Tests\Stubs\SelfWireNestedLevelStub;
use Maph\Tests\Stubs\SelfWireOneLevelStub;
use Maph\Tests\Stubs\SelfWireStubSimple;
use Maph\Tests\Stubs\SelfWireUnconstructableStub;

class SelfWireTest extends TestCase
{
    public function testCanWireSimpleClass()
    {
        $stub = SelfWireStubSimple::wire();
        static::assertInstanceOf(SelfWireStubSimple::class, $stub);
    }

    public function testCantConstructStubWithScalarTypes()
    {
        static::expectException(\InvalidArgumentException::class);
        SelfWireUnconstructableStub::wire();
    }

    public function testCanWireComplexClass()
    {
        $stub = SelfWireOneLevelStub::wire();
        static::assertInstanceOf(SelfWireOneLevelStub::class, $stub);
    }

    public function testCanWireNestedComplexClass()
    {
        $stub = SelfWireNestedLevelStub::wire();
        static::assertInstanceOf(SelfWireNestedLevelStub::class, $stub);
    }
}
