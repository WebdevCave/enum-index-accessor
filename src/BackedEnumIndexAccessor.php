<?php

namespace WebdevCave\EnumIndexAccessor;

trait BackedEnumIndexAccessor
{
    use PureEnumIndexAccessor;

    /**
     * @param string $index
     * @return mixed
     */
    public static function value(string $index): mixed
    {
        return self::fromIndex($index)->value;
    }

    /**
     * @param string $index
     * @return mixed
     */
    public static function tryValue(string $index): mixed
    {
        return self::hasIndex($index) ? self::value($index) : null;
    }
}
