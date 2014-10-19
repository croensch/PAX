<?php

namespace PAX\Soap\Client\Protocol\Native;

class SoapClient extends \SoapClient
{
    protected $_callBack;

    public function setCallBack($callBack)
    {
        $this->_callBack = $callBack;
    }

    public function __doRequest($request, $location, $action, $version, $one_way = null)
    {
        return call_user_func($this->_callBack, $request, $location, $action, $version, $one_way);
    }
}
