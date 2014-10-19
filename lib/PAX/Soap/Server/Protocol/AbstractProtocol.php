<?php

namespace PAX\Soap\Server\Protocol;

abstract class AbstractProtocol implements Protocol
{
    protected $_options = array();

    protected $_service;

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

    public function setService($service)
    {
        $this->_service = $service;
    }

    public function getService()
    {
        return $this->_service;
    }
}
