<?php

namespace Maph\Tests\Stubs;

use Maph\Destructure;

class DestructureManyArgumentsStub
{
    use Destructure;

    public $first;
    public $second;
    public $third;
    public $fourth;
    public $fifth;

    public function __construct(\stdClass $first, bool $second, int $third, array $fourth, \DOMDocument $fifth)
    {
        $this->first = $first;
        $this->second = $second;
        $this->third = $third;
        $this->fourth = $fourth;
        $this->fifth = $fifth;
    }
}
