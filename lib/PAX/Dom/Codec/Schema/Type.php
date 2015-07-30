<?php

namespace PAX\Dom\Codec\Schema;

/**
 * @deprecated
 */
abstract class Type
{
    const BOOLEAN = 'boolean';
    const FLOAT   = 'float';
    const INTEGER = 'integer';
    const STRING  = 'string';

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
            /* BOOLEANS */
            case static::BOOLEAN:
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
            /* FLOATS */
            case 'double':
            case static::FLOAT:
                return (float) $data;
            /* INTEGERS */
            case 'int':
            case static::INTEGER:
            case 'decimal':
            case 'long':
            case 'short':
            case 'byte':
                return (integer) $data;
            /* STRINGS */
            case static::STRING:
                return (string) $data;
            default:
                return $data;
        }
    }
}
