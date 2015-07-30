<?php

namespace PAX\Soap\Client\Transport;

use PAX\Soap\Client\Transport;

abstract class AbstractTransport implements Transport
{
    protected $_options = array();

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

    public function getOptions()
    {
        return $this->_options;
    }
}
