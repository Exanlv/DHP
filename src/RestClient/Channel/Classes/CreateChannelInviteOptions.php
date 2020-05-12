<?php

namespace DHP\RestClient\Channel\Classes;

class CreateChannelInviteOptions
{
    /**
     * @var int
     */
    public $max_age;

    /**
     * @var int
     */
    public $max_users;

    /**
     * @var boolean
     */
    public $temporary;

    /**
     * @var boolean
     */
    public $unique;

    /**
     * @var string
     */
    public $target_user;

    /**
     * @var int
     */
    public $target_user_type;
}