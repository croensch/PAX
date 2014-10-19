<?php
namespace PAX\Dom\Codec\Schema\AnySimpleType;

use PAX\Dom\Codec\Schema\AnySimpleType;

class Integer extends String implements AnySimpleType, Codec
{
    public function decode(\DOMNode $node)
    {
        return (integer) $node->nodeValue;
    }
}
