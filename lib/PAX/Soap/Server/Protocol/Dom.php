<?php

namespace PAX\Soap\Server\Protocol;

use PAX\Soap\Server\Protocol\AbstractProtocol;
use PAX\Soap\Server\Service;

class Dom extends AbstractProtocol
{
    protected $_dom;

    public function handle($request)
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
