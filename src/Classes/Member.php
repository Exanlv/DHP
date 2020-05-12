<?php

namespace DHP\Classes;

use DateTime;
use DateTimeZone;
use DHP\RestClient\Client as RestClient;

class Member
{
    /**
     * @var RestClient
     */
    private $rest_client;

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $nickname;

    /**
     * @var Role[]
     */
    public $roles = [];

    /**
     * @var DateTime
     */
    public $joined_at;

    /**
     * @var DateTime
     */
    public $premium_since;

    /**
     * @var boolean
     */
    public $deaf;

    /**
     * @var boolean
     */
    public $mute;

    public function __construct($data, RestClient &$rest_client)
    {
        $this->rest_client = &$rest_client;

        if (property_exists($data, 'user'))
            $this->user = new User($data->user, $this->rest_client);

        if (property_exists($data, 'nick'))
            $this->nickname = $data->nick;

        foreach ($this->roles as $role)
            $this->roles[] = new Role($role, $this->rest_client);


        $utc_timezone = new DateTimeZone('UTC');

        $this->joined_at = new DateTime($data->joined_at, $utc_timezone);

        if (property_exists($data, 'premium_since'))
            $this->premium_since = new DateTime($data->premium_since, $utc_timezone);

        $this->deaf = $data->deaf;

        $this->mute = $data->mute;
    }
}
