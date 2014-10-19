<?php

namespace PAX\Dom;

interface Codec
{
    /**
     * @param mixed $data
     */
    public function encode($data);

    /**
     * @return mixed
     */
    public function decode();
}