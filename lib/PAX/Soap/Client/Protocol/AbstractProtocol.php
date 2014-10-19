<?php
namespace PAX\Soap\Client\Protocol;

use PAX\Soap\Client\Protocol;
use PAX\Soap\Client\Transport;

abstract class AbstractProtocol implements Protocol
{
    protected $_options = array();

    protected $_transport;

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

    public function setTransport(Transport $transport)
    {
        $this->_transport = $transport;
    }

    public function getTransport()
    {
        return $this->_transport;
    }
}