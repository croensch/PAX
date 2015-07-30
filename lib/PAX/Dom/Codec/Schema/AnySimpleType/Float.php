<?php

namespace PAX\Dom\Codec\Schema\AnySimpleType;

use PAX\Dom\Codec\Schema\AnySimpleType;

class Float extends AnySimpleType
{
    public function decode(\DOMNode $node)
    {
        return (float) $node->nodeValue;
    }
}
