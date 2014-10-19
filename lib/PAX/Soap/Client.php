<?php

namespace PAX\Soap;

use PAX\Soap\Client\Protocol;
use PAX\Soap\Client\Transport;

class Client
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

    public function __call($name, $args)
    {
        return $this->call($name, $args);
    }
    
    public function setProtocol(Protocol $protocol)
    {
        $this->_protocol = $protocol;
    }

    public function getProtocol()
    {
        if ($this->_protocol === null) {
            $this->_protocol = new Protocol\Native($this->_options);
        }
        return $this->_protocol;
    }

    public function setTransport(Transport $transport)
    {
        $this->getProtocol()->setTransport($transport);
    }

    public function getTransport()
    {
        $this->getProtocol()->getTransport();
    }

    public function call($name, $args)
    {
        $this->getProtocol()->call($name, $args);
    }
}
