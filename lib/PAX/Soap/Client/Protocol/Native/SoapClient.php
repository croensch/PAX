<?php

namespace PAX\Soap\Client\Protocol\Native;

use PAX\Soap\Client\Protocol;

class SoapClient extends \SoapClient
{
    protected $_protocol;

    public function setProtocol(Protocol\Native $protocol)
    {
        $this->_protocol = $protocol;
    }

    public function getProtocol()
    {
        if ($this->_protocol === null) {
            throw new \Exception('protocol');
        }
        return $this->_protocol;
    }

    public function __doRequest($request, $location, $action, $version, $one_way = null)
    {
        return $this->getProtocol()->send($request, $location, $action, $version, $one_way);
    }
}
