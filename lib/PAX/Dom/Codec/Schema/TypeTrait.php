<?php
namespace PAX\Dom\Codec\Schema;

use PAX\Dom\Codec\Schema\SimpleType;

/**
 * LEGENDARY
 */
trait TypeTrait
{
    use SchemaTrait;

    const TYPE_BOOLEAN = 'boolean';
    const TYPE_FLOAT   = 'float';
    const TYPE_INTEGER = 'integer';
    const TYPE_STRING  = 'string';

    protected static $_types;

    /**
     * @param \Hgs_Dom_Codec|string
     * @return \Hgs_Dom_Codec
     */
    protected function _getType($type = null)
    {
        if ($type === null) {
            $type = $this->type;
        }

        if (is_object($type)) {
            return $type;
        }

        if (is_string($type)) {
            if ($complexType = $this->_getSchema()->getComplexType($type)) {
                return $complexType;
            }
            if ($simpleType = $this->_getSchema()->getSimpleType($type)) {
                return $simpleType;
            }
            if (self::$_types === null) {
                self::$_types = array(
                    self::TYPE_BOOLEAN => new AnySimpleType\Boolean,
                    self::TYPE_INTEGER => new AnySimpleType\Integer,
                    self::TYPE_FLOAT   => new AnySimpleType\Float,
                    self::TYPE_STRING  => new AnySimpleType\String,
                );
            }
            if (isset(self::$_types[$type])) {
                return self::$_types[$type];
            }
            switch ($type) {
                /* BOOLEANS */
                case 'boolean':
                    return self::$_types[$type] = self::$types[self::TYPE_BOOLEAN];
                /* FLOATS */
                case 'float':
                case 'double':
                    return self::$_types[$type] = self::$types[self::TYPE_FLOAT];
                /* INTEGERS */
                case 'int':
                case 'integer':
                case 'decimal':
                case 'long':
                case 'short':
                case 'byte':
                    return self::$_types[$type] = self::$types[self::TYPE_INTEGER];
                /* STRINGS */
                case 'string':
                    return self::$_types[$type] = self::$types[self::TYPE_STRING];
                default:
                    return null;
            }
        }
    }
}
