<?php
namespace PAX\Dom\Codec\Schema\AnySimpleType;

use PAX\Dom\Codec\Schema\AnySimpleType;

class Float extends String implements AnySimpleType, Codec
{
    public function decode(\DOMNode $node)
    {
        return (float) $node->nodeValue;
    }
}
