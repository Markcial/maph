<?php

namespace Maph\Tests;

use PHPUnit\Framework\TestCase;
use Maph\Tests\Stubs\DestructureManyArgumentsStub;
use Maph\Tests\Stubs\DestructureSingleStub;
use Maph\Tests\Stubs\DestructureTypedStub;

class DestructureTest extends TestCase
{
    public function testSimple()
    {
        $stub = DestructureSingleStub::create(['one' => 1]);
        static::assertInstanceOf(DestructureSingleStub::class, $stub);
        static::assertEquals(1, $stub->one);
    }

    public function testCanDestructureWithTypeHint()
    {
        $obj = new \stdClass();
        $obj->foo = 12;

        $stub = DestructureTypedStub::create(['second' => 3, 'first' => $obj]);

        static::assertInstanceOf(DestructureTypedStub::class, $stub);
        static::assertEquals($obj, $stub->first);
        static::assertEquals(3, $stub->second);
    }

    public function testDestructureFailsWithWrongTypeHints()
    {
        static::expectException(\TypeError::class);
        DestructureTypedStub::create(['second' => 3, 'first' => 'some text']);
    }

    public function testDestructureWithManyArguments()
    {
        $doc = new \DOMDocument();
        $array = ['a', 'b', 1, 54];
        $object = new \stdClass();
        $bool = true;
        $int = 12;

        $stub = DestructureManyArgumentsStub::create([
            'fourth' => $array,
            'first' => $object,
            'second' => $bool,
            'fifth' => $doc,
            'third' => $int
        ]);
        static::assertInstanceOf(DestructureManyArgumentsStub::class, $stub);
    }
}
