<?php

namespace PAX\Dom\Codec;

use PAX\DOM\Document;
use PAX\Dom\Codec;
use PAX\Dom\Codec\Schema as SchemaCodec;

class Wsdl implements Codec
{
    /**
     * @var \DOMDocument
     */
    protected $_dom;

    /**
     * @var \Hgs_Dom_Wsdl
     */
    protected $_wsdl;

    /**
     * @var \PAX\Dom\Codec\Schema
     */
    protected $_wsdlSchemaCodec;

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
     * @param \Hgs_Dom_Wsdl $wsdl
     */
    public function setWsdl(\Hgs_Dom_Wsdl $wsdl)
    {
        $this->_wsdl = $wsdl;
    }

    /**
     * @return \Hgs_Dom_Wsdl
     */
    public function getWsdl()
    {
        return $this->_wsdl;
    }

    /**
     * @param SchemaCodec $wsdlSchemaCodec
     */
    protected function _setWsdlSchemaCodec(SchemaCodec $wsdlSchemaCodec)
    {
        $this->_wsdlSchemaCodec = $wsdlSchemaCodec;
    }

    /**
     * @return SchemaCodec
     */
    protected function _getWsdlSchemaCodec()
    {
        if ($this->_wsdlSchemaCodec === null) {
            $this->_wsdlSchemaCodec = new SchemaCodec();
            $this->_wsdlSchemaCodec->setSchema($this->getWsdl()->getSchema());
        }
        return $this->_wsdlSchemaCodec;
    }

    public function encode($data, \DOMDocument $document)
    {
        // @todo ...
        $this->_getWsdlSchemaCodec()->encode($data, $document);
    }

    public function decode(\DOMNode $node)
    {
        // @todo ...
        return $this->_getWsdlSchemaCodec()->decode($node);
    }
}
