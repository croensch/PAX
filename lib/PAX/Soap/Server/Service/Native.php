<?php
/**
 * @todo \iSoapService
 */

namespace PAX\Soap\Server\Service;

use PAX\Soap\Server\Service;

class Native implements Service
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
}
