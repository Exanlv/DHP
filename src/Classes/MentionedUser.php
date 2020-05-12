<?php
namespace DHP\Classes;

use DHP\Classes\PartialMember;
use DHP\Classes\User;
use DHP\RestClient\Client as RestClient;

class MentionedUser
{
    /**
     * @var RestClient
     */
    private $rest_client;

    /**
     * @var PartialMember;
     */
    public $partial_member;

    /**
     * @var User
     */
    public $user;

    public function __construct($data, RestClient &$rest_client)
    {
        $this->rest_client = &$rest_client;

        $this->user = new User($data, $this->rest_client);

        if (property_exists($data, 'member'))
            $this->partial_member = new PartialMember($data->member);
    }
}