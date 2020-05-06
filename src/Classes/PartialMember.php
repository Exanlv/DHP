<?php
namespace DHP\Classes;

use DateTime;
use DateTimeZone;

class PartialMember
{
    /**
     * @var string
     */
    public $nickname;

    /**
     * @var array
     */
    public $roles;

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

    public function __construct($data)
    {
        $utc_time_zone = new DateTimeZone('UTC');

        if (property_exists($data, 'nick'))
            $this->nickname = $data->nick;
            
        $this->roles = $data->roles;
        $this->joined_at = new DateTime($data->joined_at, $utc_time_zone);
        
        if (property_exists($data, 'premium_since'))
            $this->premium_since = new DateTime($data->premium_since, $utc_time_zone);

        $this->deaf = $data->deaf;
        $this->mute = $data->mute;
    }
}