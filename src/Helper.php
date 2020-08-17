<?php

if (! function_exists('array_get')) {
    /**
     * Get an item from an array using "dot" notation.
     * 
     * @see https://github.com/rappasoft/laravel-helpers/blob/c8dfa1e979437528262725ebe99c2e6383b24c16/src/helpers.php#L236
     * @param array  $array
     * @param string $key
     * @param mixed  $default
     * @return mixed
     */
    function array_get(array $array, string $key, $default = null)
    {
        if (is_null($key)) {
            return $array;
        }

        if (isset($array[$key])) {
            return $array[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (! is_array($array) || ! array_key_exists($segment, $array)) {
                return value($default);
            }

            $array = $array[$segment];
        }

        return $array;
    }
}

if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     * 
     * @see https://github.com/rappasoft/laravel-helpers/blob/c8dfa1e979437528262725ebe99c2e6383b24c16/src/helpers.php#L1424
     * @param mixed $value
     * @return mmixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}
