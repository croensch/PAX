<?php

namespace PAX\Soap;

use PAX\Soap\Server\Protocol;

class Server
{
    protected $_options = array();

    protected $_protocol;

    public function __construct(array $options)
    {
        $this->setOptions($options);
    }

    public function setOptions(array $options)
    {
        $this->_options = array_merge_recursive(
            $this->_options,
            $options
        );
    }

    public function setProtocol(Protocol $protocol)
    {
        return $this->_protocol = $protocol;
    }

    public function getProtocol()
    {
        if ($this->_protocol === null) {
            $this->_protocol = new Protocol\Native($this->_options);
        }
        return $this->_protocol;
    }

    public function setService($service)
    {
        $this->getProtocol()->setService($service);
    }

    public function getService()
    {
        return $this->getProtocol()->getService();
    }

    public function handle()
    {
        $this->getProtocol()->handle();
    }
}
