<?php

namespace Maph;


trait SelfWire
{
    public static function wire()
    {
        $class = new \ReflectionClass(static::class);
        if (!$class->hasMethod('__construct')) {
            return $class->newInstanceWithoutConstructor();
        }

        $constructor = $class->getMethod('__construct');
        $untyped = array_filter($constructor->getParameters(), function (\ReflectionParameter $parameter) {
            return $parameter->getClass() === null;
        });

        if (!empty($untyped)) {
            throw new \InvalidArgumentException("Some parameters cannot be self wired. Only complex types can be created");
        }

        $params = array_map(function (\ReflectionParameter $parameter) {
            $class = $parameter->getClass();
            if (!$class->hasMethod('__construct')) {
                return $class->newInstanceWithoutConstructor();
            }
            $constructor = $class->getMethod('__construct');
            if (count($constructor->getParameters()) > 0) {
                if (!array_key_exists(SelfWire::class, $class->getTraits())) {
                    throw new \InvalidArgumentException("Object cannot be self wired and needs arguments for construction.");
                }

                $wire = $class->getMethod('wire');

                return $wire->invoke(null);
            }

            return $class->newInstance();
        }, $constructor->getParameters());

        return $class->newInstanceArgs($params);
    }
}