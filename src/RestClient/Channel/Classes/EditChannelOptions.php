<?php

namespace DHP\RestClient\Channel\Classes;

class EditChannelOptions
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var integer
     */
    public $type;

    /**
     * @var integer
     */
    public $position;

    /**
     * @var boolean
     */
    public $nsfw;

    /**
     * @var integer
     */
    public $rate_limit_per_user;

    /**
     * @var integer
     */
    public $bitrate;

    /**
     * @var integer
     */
    public $user_limit;

    /**
     * @var array
     */
    public $permission_overwrites;
    
    /**
     * @var string
     */
    public $parent_id;

    /**
     * @todo
     * 
     * permission overwrites
     */
}