<?php

namespace PAX\Dom\Codec\Schema;

use PAX\Dom\Codec;

class SimpleType /*extends \Hgs_Dom_Schema_SimpleType*/ implements Codec
{
    use TypeTrait;

    public function encode($data, \DOMDocument $document)
    {
        if ($this->restriction && $this->restriction->base) {
            if ($baseType = $this->_getType($this->restriction->base)) {
                return $baseType->encode($data, $document);
            }
        }
    }

    public function decode(\DOMNode $node)
    {
        if ($this->restriction && $this->restriction->base) {
            if ($baseType = $this->_getType($this->restriction->base)) {
                return $baseType->decode($node, $document);
            }
        }
    }
}
