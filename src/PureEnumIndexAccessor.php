<?php

namespace WebdevCave\EnumIndexAccessor;

trait PureEnumIndexAccessor
{
    /**
     * @param string $index
     * @return bool
     */
    public static function hasIndex(string $index): bool
    {
        return defined(self::class."::$index");
    }

    /**
     * @param string $index
     * @return mixed
     */
    public static function fromIndex(string $index): mixed
    {
        return constant(self::class."::$index");
    }

    /**
     * @param string $index
     * @return mixed
     */
    public static function tryFromIndex(string $index): mixed
    {
        return self::hasIndex($index) ? self::fromIndex($index) : null;
    }
}
