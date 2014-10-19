<?php

namespace PAX\Soap\Client;

use PAX\Soap\Client\Transport;

interface Protocol
{
    public function setTransport(Transport $transport);

    public function getTransport();

    public function call($name, $args);
}