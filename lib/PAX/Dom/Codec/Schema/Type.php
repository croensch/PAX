<?php

namespace PAX\Dom\Codec\Schema;

/**
 * @deprecated
 */
abstract class Type
{
    /**
     * @param mixed  $data
     * @param string $type
     * @return string
     */
    public static function encode($data, $type = null)
    {
        return (string) $data;
    }

    /**
     * @param string $data
     * @param string $type
     * @return mixed
     */
    public static function decode($data, $type)
    {
        switch ($type) {
            /* STRINGS */
            case 'string':
                return (string) $data;
            /* BOOLEANS */
            case 'boolean':
                switch ($data) {
                    case 1:
                    case 'true':
                        return true;
                    case 0:
                    case 'false':
                        return false;
                    default:
                        return (boolean) $data;
                }
            /* INTEGERS */
            case 'int':
            case 'integer':
            case 'decimal':
            case 'long':
            case 'short':
            case 'byte':
                return (integer) $data;
            /* FLOATS */
            case 'float':
            case 'double':
                return (float) $data;
            default:
                return $data;
        }
    }
}
