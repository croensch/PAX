<?php

namespace PAX\Dom\Codec\Schema\AnySimpleType;

use PAX\Dom\Codec\Schema\AnySimpleType;

class String extends AnySimpleType
{
    public function decode(\DOMNode $node)
    {
        return $node->nodeValue;
    }
}
