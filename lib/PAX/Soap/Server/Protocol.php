<?php

namespace PAX\Soap\Server;

interface Protocol
{
    public function setService($service);

    public function getService();

    abstract public function handle($request);
}
