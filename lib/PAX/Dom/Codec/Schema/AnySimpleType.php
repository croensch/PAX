<?php

namespace PAX\Dom\Codec\Schema;

use PAX\Dom\Codec;

abstract class AnySimpleType implements AnyType, Codec
{
    public function encode($data, \DOMDocument $document)
    {
        return $document->createTextNode((string) $data);
    }
}