<?php

namespace PAX\Dom\Codec\Schema\AnySimpleType;

use PAX\Dom\Codec\Schema\AnySimpleType;

class Integer extends AnySimpleType
{
    public function decode(\DOMNode $node)
    {
        return (integer) $node->nodeValue;
    }
}
