<?php
namespace PAX\Soap\Util;

class SoapVar
{
    /**
     * @param string $data
     * @param string $node_name
     * @param string $node_namespace
     * @param string $data_encoding
     * @return SoapVar
     */
    public static function wrapCDATA($data, $node_name = null, $node_namespace = null, $data_encoding = 'UTF-8')
    {
        $document = new \DOMDocument('1.0', $data_encoding);
        if ($node_namespace) {
            $wrapper = $document->createElementNS($node_namespace, $node_name);
        } else {
            $wrapper = $document->createElement($node_name);
        }
        $cdata = $wrapper->appendChild($document->createCDATASection($data));
        $data = $document->saveXML($wrapper);
        return new \SoapVar($data, XSD_ANYXML, null, null, $node_name, $node_namespace);
    }
}