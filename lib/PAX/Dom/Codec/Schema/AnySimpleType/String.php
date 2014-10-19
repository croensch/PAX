<?php
namespace PAX\Dom\Codec\Schema\AnySimpleType;

use PAX\Dom\Codec\Schema\AnySimpleType;

class String implements AnySimpleType, Codec
{
    public function encode($data, \DOMDocument $document)
    {
        return $document->createTextNode((string) $data);
    }

    public function decode(\DOMNode $node)
    {
        return $node->nodeValue;
    }
}
