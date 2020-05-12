<?php

namespace DHP\Classes;

use DHP\RestClient\Client as RestClient;

class Invite
{
    /**
     * @var RestClient
     */
    public $rest_client;

    /**
     * @var string
     */
    public $code;

    /**
     * @var Guild
     */
    public $guild;

    /**
     * @var PartialChannel
     */
    public $channel;

    /**
     * @var User
     */
    public $inviter;

    /**
     * @var PartialUser
     */
    public $target_user;

    /**
     * @var int
     */
    public $target_user_type;

    /**
     * @var int
     */
    public $approximate_presence_count;
    
    /**
     * @var int
     */
    public $approximate_member_count;

    public function __construct($data, RestClient &$rest_client)
    {
        $this->rest_client = &$rest_client;

        $this->code = $data->code;

        if (property_exists($data, 'guild'));
            $this->guild = new Guild($data->guild, $this->rest_client);
        
        $this->channel = new Channel($data, $this->rest_client);

        if (property_exists($data, 'inviter'))
            $this->inviter = new User($data->inviter, $this->rest_client);
        
        if (property_exists($data, 'target_user'))
            $this->target_user = new User($data->target_user, $this->rest_client);

        if (property_exists($data, 'target_user_type'))
            $this->target_user_type = $data->target_user_type;

        if (property_exists($data, 'approximate_presence_count'))
            $this->approximate_presence_count = $data->approximate_presence_count;

        if (property_exists($data, 'approximate_member_count'))
            $this->approximate_member_count = $data->approximate_member_count;
    }
}