<?php
namespace PAX\Dom\Codec\Schema;

/**
 * LEGENDARY
 */
trait TypeTrait
{
    use SchemaTrait;

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
            if ($complexType = $this->getSchema()->getComplexType($type)) {
                return $complexType;
            }
            /*if ($simpleType = $this->getSchema()->getSimpleType($type)) {
                return $simpleType;
            }*/
            if (self::$_types === null) {
                self::$_types = array(
                    'boolean' => new AnySimpleType\Boolean,
                    'float'   => new AnySimpleType\Float,
                    'integer' => new AnySimpleType\Integer,
                    'string'  => new AnySimpleType\String
                );
            }
            if (isset(self::$_types[$type])) {
                return self::$_types[$type];
            }
            switch ($type) {
                /* BOOLEANS */
                case 'boolean':
                    return self::$_types[$type] = self::$types['boolean'];
                /* FLOATS */
                case 'float':
                case 'double':
                    return self::$_types[$type] = self::$types['float'];
                /* INTEGERS */
                case 'int':
                case 'integer':
                case 'decimal':
                case 'long':
                case 'short':
                case 'byte':
                    return self::$_types[$type] = self::$types['integer'];
                /* STRINGS */
                case 'string':
                    return self::$_types[$type] = self::$types['string'];
                default:
                    return null;
            }
        }
    }
}
