<?php
declare(strict_types=1);

namespace App\Helpers;

abstract class MakeableDto
{

    public static function make(...$args): static {
        $class = static::class;
        $reflection = new \ReflectionClass($class);
        $constructor = $reflection->getConstructor();

        if ($constructor) {
            $parameters = $constructor->getParameters();
            $args = self::prepareArgs($parameters, $args);
        }

        return new $class(...$args);
    }

    private static function prepareArgs($parameters, $args) {
        $args = array_slice($args, 0, count($parameters));
        $missing = count($parameters) - count($args);

        if ($missing > 0) {
            throw new \InvalidArgumentException(sprintf(
                'Too few arguments provided, expected at least %d, got %d.',
                count($parameters),
                count($args)
            ));
        }

        return $args;
    }

}
