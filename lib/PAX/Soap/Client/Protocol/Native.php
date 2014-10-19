<?php

namespace PAX\Soap\Client\Protocol;

use PAX\Soap\Client\Protocol\AbstractProtocol;
use PAX\Soap\Client\Protocol\Native;
use PAX\Soap\Client\Transport;

class Native extends AbstractProtocol
{
    protected $_soapClient;

    public function __construct($options)
    {
        parent::__construct($options);
    }

    public function getTransport()
    {
        if ($this->_transport === null) {
            $this->_transport = new Transport\Native($this->_options);
            $this->_transport->setSoapClient($this->getSoapClient());
        }
        return $this->_transport;
    }

    public function setSoapClient(\SoapClient $soapClient)
    {
        $this->_soapClient = $soapClient;
    }

    public function getSoapClient()
    {
        if ($this->_soapClient === null) {
            $this->_soapClient = new Native\SoapClient(null, $this->_options);
            $this->_soapClient->setCallBack(array($this, '__callBack'));
        }
        return $this->_soapClient;
    }

    public function call($name, $args)
    {
        return $this->_soapClient->__call($name, $args);
    }

    public function __callBack($request, $location, $action, $version, $one_way = null)
    {
        return $this->_transport->send($request, $location, $action, $version, $one_way);
    }
}
