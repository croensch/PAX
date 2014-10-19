<?php

namespace PAX\Dom\Codec;

use PAX\DOM\Document;
use PAX\Dom\Codec;
use PAX\Dom\Codec\Element;

class Schema extends \Hgs_Dom_Schema implements Codec
{
    /**
     * @var \DOMDocument
     */
    protected $_dom;

    /**
     * @var \Hgs_Dom_Schema
     */
    protected $_schema;

    /**
     * @param \DOMDocument $dom
     */
    public function setDom(\DOMDocument $dom)
    {
        $this->_dom = $dom;
    }

    /**
     * @return \DOMDocument
     */
    public function getDom()
    {
        if ($this->_dom === null) {
            $this->_dom = new Document();
        }
        return $this->_dom;
    }

    /**
     * @param \Hgs_Dom_Schema $schema
     */
    public function setSchema(\Hgs_Dom_Schema $schema)
    {
        $this->_schema = $schema;
    }

    /**
     * @return \Hgs_Dom_Schema
     */
    public function getSchema()
    {
        return $this->_schema;
    }

    /**
     * @param string $elementName
     * @return Element|null
     */
    protected function _getRootElement($elementName)
    {
        $element = null;

        if ($elementName) {
            $element = $this->getSchema()->getElement($elementName);
        } elseif ($elements = $this->getSchema()->getElements()) {
            $element = reset($elements);
        }

        return $element;
    }

    public function encode($data, $elementName = null)
    {
        if (!($element = $this->_getRootElement($elementName))) {
            return;
        }

        $node = $element->encode($data, $this->getDom());
        $this->getDom()->appendChild($node);
    }

    public function decode($elementName = null)
    {
        if (!($element = $this->_getRootElement($elementName))) {
            return;
        }

        foreach ($this->getDom()->childNodes as $node) {
            if ($node instanceof \DOMElement) {
                if ($node->nodeName === $element->name) {
                    return $element->decode($node);
                }
            }
        }
    }
}
