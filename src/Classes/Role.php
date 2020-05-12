<?php

namespace DHP\Classes;

use DHP\RestClient\Client as RestClient;

class Role
{
    /**
     * @var RestClient
     */
    private $rest_client;

    /**
     * @var string
     */
    public $id;

    /**
    * @var string
     */
    public $name;

    /**
     * @var integer
     */
    public $color;

    /**
     * @var boolean
     */
    public $hoist;

    /**
     * @var integer
     */
    public $position;

    /**
     * @var integer
     */
    public $permissions;

    /**
     * @var boolean
     */
    public $managed;

    /**
     * @var boolean
     */
    public $mentionable;

    public function __construct($data, RestClient &$rest_client)
    {
        $this->rest_client = &$rest_client;

        $this->id = $data->id;

        $this->name = $data->name;

        $this->color = $data->color;

        $this->hoist = $data->hoist;

        $this->position = $data->position;

        $this->permissions = $data->permissions;

        $this->managed = $data->managed;

        $this->mentionable = $data->mentionable;
    }
}