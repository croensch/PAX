<?php

namespace PAX\Dom\Codec\Schema;

use PAX\Dom\Codec;

class Element /*extends \Hgs_Dom_Schema_Element*/ implements Codec
{
    use TypeTrait;

    public function encode($data, \DOMDocument $document)
    {
        $node = $document->createElement($this->name);

        if ($data === null && $this->nillable) {
            $node->setAttribute('xsi:nil', "true"); // @todo NS
            return $node;
        }

        if ($type = $this->_getType()) {
            $node->appendChild($type->encode($data, $document));
        }

        return $node;
    }

    public function decode(\DOMNode $node)
    {
        if (!($node instanceof \DOMAttribute)) {
            throw new \InvalidArgumentException('node', 1);
        }

        if ($this->nillable && $node->getAttribute('xsi:nil') === "true") { // @todo NS
            return null;
        }

        if ($type = $this->_getType()) {
            return $type->decode($node);
        }
    }
}
