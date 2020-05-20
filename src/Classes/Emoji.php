<?php

namespace DHP\Classes;

use DHP\RestClient\Client as RestClient;

class Emoji
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
     * @var Role[]
     */
    public $roles;

    /**
     * @var User
     */
    public $user;

    /**
     * @var boolean
     */
    public $require_colons;

    /**
     * @var boolean
     */
    public $managed;

    /**
     * @var boolean
     */
    public $animated;

    /**
     * @var boolean
     */
    public $available;

    public function __construct($data, RestClient &$rest_client)
    {
        $this->rest_client = &$rest_client;

        $this->id = $data->id;

        $this->name = $data->name;

        if (property_exists($data, 'roles'))
            foreach ($data->roles as $role)
                $this->roles[] = new Role($role, $this->rest_client);

        if (property_exists($data, 'user'))
            $this->user = new User($data->user, $this->rest_client);

        if (property_exists($data, 'require_colons'))
            $this->require_colons = $data->require_colons;

        if (property_exists($data, 'managed'))
            $this->managed = $data->managed;

        if (property_exists($data, 'animated'))
            $this->animated = $data->animated;

        if (property_exists($data, 'available'))
            $this->available = $data->available;
    }

    public function url_identifier()
    {
        return urlencode($this->name . ':' . $this->id);
    }
}