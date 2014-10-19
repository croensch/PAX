<?php

namespace PAX\Soap\Server\Protocol;

use PAX\Soap\Server\Protocol as ServerProtocol;
use PAX\Soap\Server\Service;

class Dom extends ServerProtocol
{
    protected $_dom;

    public function hande($request)
    {
        $request = $this->_dom->decode($request);
        $args = $request['Envelope']['Body'];
        try {
            $response = call_user_func_array(array($this->getService(), $name), $args);
            $response['Envelope']['Body'] = $response;
        } catch (\Exception $exception) {
            $response['Envelope']['Fault'] = $exception;
        }
        $response = $this->_dom->encode($response);
        return $response;
    }
}
