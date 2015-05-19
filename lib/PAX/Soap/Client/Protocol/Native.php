<?php

namespace PAX\Soap\Client\Protocol;

use PAX\Soap\Client\Transport;

class Native extends AbstractProtocol
{
    protected $_soapClient;

    public function setTransport(Transport $transport)
    {
        if ($transport instanceof Transport\Native) {
            $transport->setSoapClient($this->getSoapClient());
        }
        $this->_transport = $transport;
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
        if ($this->getTransport() instanceof Transport\Native) {
            $this->getTransport()->setSoapClient($soapClient);
        }
    }

    public function getSoapClient()
    {
        if ($this->_soapClient === null) {
            $this->_soapClient = new Native\SoapClient(null, $this->_options);
            $this->_soapClient->setProtocol($this);
        }
        return $this->_soapClient;
    }

    public function call($name, $args)
    {
        return $this->getSoapClient()->__call($name, $args);
    }

    /**
     * @internal
     */
    public function send($request, $location, $action, $version, $one_way = null)
    {
        return $this->getTransport()->send($request, $location, $action, $version, $one_way);
    }
}
