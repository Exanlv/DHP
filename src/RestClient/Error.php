<?php

namespace DHP\RestClient;

class Error
{
    /**
     * @var string
     */
    public $code;

    /**
     * @var any
     */
    public $data;

    public function __construct($code, $data)
    {
        $this->code = $code;

        $this->data = $data;
    }
}