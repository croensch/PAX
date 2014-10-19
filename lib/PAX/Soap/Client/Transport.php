<?php

namespace PAX\Soap\Client;

interface Transport
{
    public function send($request, $location, $action, $version, $one_way = null);
}
