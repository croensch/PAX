<?php

namespace PAX\Dom\Codec\Schema;

use PAX\Dom\Codec;

class Attribute extends \Hgs_Dom_Schema_Attribute implements Codec
{
    use SchemaTrait;
    use TypeTrait;

    public function encode($data, \DOMDocument $document)
    {
        $node = $document->createAttribute($this->name);

        if ($type = $this->_getType()) {
            $node->appendChild($type->encode($data, $document));
        }

        return $node;
    }

    public function decode(\DOMAttribute $node)
    {
        if ($type = $this->_getType()) {
            return $type->decode($node);
        }
    }
}
