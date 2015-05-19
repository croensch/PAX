<?php

namespace PAX\Soap\Client\Transport;

use PAX\Soap\Client\Transport\AbstractTransport;

class Native extends AbstractTransport
{
    protected $_soapClient;

    public function setSoapClient(\SoapClient $soapClient)
    {
        $this->_soapClient = $soapClient;
    }

    public function getSoapClient()
    {
        if ($this->_soapClient === null) {
            $this->_soapClient = new \SoapClient(null, $this->_options);
        }
        return $this->_soapClient;
    }

    public function send($request, $location, $action, $version, $one_way = null)
    {
        if ($one_way == null) {
            return call_user_func(array($this->getSoapClient(), 'SoapClient::__doRequest'), $request, $location, $action, $version);
        } else {
            return call_user_func(array($this->getSoapClient(), 'SoapClient::__doRequest'), $request, $location, $action, $version, $one_way);
        }
    }
}
