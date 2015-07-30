<?php

namespace PAX\Dom;

interface Codec
{
    /**
     * @param mixed $data
     * @param \DOMDocument $document
     */
    public function encode($data, \DOMDocument $document);

    /**
     * @param \DOMNode $node
     * @return mixed
     */
    public function decode(\DOMNode $node);
}