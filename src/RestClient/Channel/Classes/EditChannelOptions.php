<?php

namespace DHP\RestClient\Channel\Classes;

class EditChannelOptions
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $type;

    /**
     * @var int
     */
    public $position;

    /**
     * @var boolean
     */
    public $nsfw;

    /**
     * @var int
     */
    public $rate_limit_per_user;

    /**
     * @var int
     */
    public $bitrate;

    /**
     * @var int
     */
    public $user_limit;

    /**
     * @var PermissionOverwrite[]
     */
    public $permission_overwrites;
    
    /**
     * @var string
     */
    public $parent_id;
}