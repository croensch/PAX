<?php

namespace PAX\Dom\Codec\Schema\AnySimpleType;

use PAX\Dom\Codec\Schema\AnySimpleType;

class Boolean extends AnySimpleType
{
    const TRUE_STR  = 'true';
    const TRUE_NUM  = '1';
    const FALSE_STR = 'false';
    const FALSE_NUM = '0';

    public function encode($data, \DOMDocument $document)
    {
        if ($data === true) {
            $data = self::TRUE_STR;
        } elseif ($data === 1) {
            $data = self::TRUE_NUM;
        } elseif ($data === false) {
            $data = self::FALSE_STR;
        } elseif ($data === 0) {
            $data = self::FALSE_NUM;
        } else {
            $data = null;
        }

        return parent::encode($data);
    }

    public function decode(\DOMNode $node)
    {
        $data = $node->nodeValue;

        if ($data === self::TRUE_STR || $data === self::TRUE_NUM) {
            return true;
        } elseif ($data === self::FALSE_STR || $data === self::FALSE_NUM) {
            return false;
        }

        return null;
    }
}
