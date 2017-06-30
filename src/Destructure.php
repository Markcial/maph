<?php

namespace Maph;


trait Destructure
{
    public static function create(array $args)
    {
        $names = array_keys($args);
        $class = new \ReflectionClass(static::class);
        $signature = $class->getMethod('__construct');

        $mapping = array_map(function (\ReflectionParameter $param) {
            return $param->getName();
        }, $signature->getParameters());

        if (!empty($missing = array_diff($mapping, $names))) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Missing "%s" argument(s).',
                    implode(", ", $missing)
                )
            );
        }

        if (!empty($extra = array_diff($names, $mapping))) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The "%s" argument(s) are not required.',
                    implode(", ", $extra)
                )
            );
        }

        return $class->newInstanceArgs(
            array_map(function ($element) use ($args) {
                return $args[$element];
            }, $mapping)
        );
    }
}
