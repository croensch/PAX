<?php
namespace PAX\Soap\Client\Protocol;

use PAX\Soap\Client\Protocol\AbstractProtocol;

class Dom extends AbstractProtocol
{
    protected $_transport;

    protected $_dom;

    public function call($name, $args)
    {
        $location = $this->_options['location'];
        $action   = $name;
        $version  = $this->_options['version'];

        $request = array(
            'Envelope' => array(
                'Body' => $args
            )
        );

        $codec = new \PAX\Dom\Codec\Wsdl;
        $codec->getWsdl()->load($this->_options['wsdl']);

        $codec->encode($request);
        $request = $codec->getDom()->saveXML();

        $response = $this->_transport->send($request, $location, $action, $version, $one_way);

        $codec->getDom()->loadXML($response);
        $response = $codec->decode($response);

        return $response['Envelope']['Body'];
    }
}
