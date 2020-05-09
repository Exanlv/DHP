<?php

namespace DHP\Classes;

class PermissioOverwrite
{
    /**
     * @var id
     */
    public $id;

    /**
     * @var string
     */
    public $type;

    /**
     * @var integer
     */
    public $allow;

    /**
     * @var integer
     */
    public $deny;

    public function __construct($data)
    {
        $this->id = $data->id;
        $this->type = $data->type;
        $this->allow = $data->allow;
        $this->deny = $data->deny;
    }
}