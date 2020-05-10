<?php

namespace DHP\Classes;

class PermissionOverwrite
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
     * @var int
     */
    public $allow;

    /**
     * @var int
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