<?php
/**
 * @todo \iSoapServer
 */

namespace PAX\Soap\Server\Protocol;

use PAX\Soap\Server\Protocol as ServerProtocol;
use PAX\Soap\Server\Service;

class Native extends ServerProtocol
{
    protected $_soapServer;

    public function setSoapServer(\SoapServer $soapServer)
    {
        $this->_soapServer = $soapServer;
    }

    public function getSoapServer()
    {
        if ($this->_soapServer === null) {
            $this->_soapServer = new \SoapServer($this->_options);
            $this->_soapServer->setObject($this->getService());
        }
        return $this->_soapServer;
    }

    public function getService()
    {
        if ($this->_service === null) {
            $this->_service = new Service\Native($this->_options);
        }
        return $this->_service;
    }

    public function handle($request)
    {
        $this->_soapServer->handle($request);
    }
}
