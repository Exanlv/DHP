<?php
namespace DHP\Classes;

class User
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $discriminator;

    /**
     * @var string
     */
    public $avatar_hash;

    /**
     * @var boolean
     */
    public $bot;

    /**
     * @var boolean
     */
    public $system;

    /**
     * @var boolean;
     */
    public $two_factor_auth;

    /**
     * @var boolean;
     */
    public $verified_email;

    /**
     * @var string
     */
    public $locale;

    /**
     * @var string;
     */
    public $email;

    /**
     * @var int
     */
    public $flags;

    /**
     * @var int
     */
    public $public_flags;

    /**
     * @var int
     */
    public $premium_type;

    /**
     * @return void
     */
    public function __construct($data)
    {
        $this->id = $data->id;
        $this->username = $data->username;
        $this->discriminator = $data->discriminator;
        $this->avatar = $data->avatar;

        if (property_exists($data, 'bot'))
            $this->bot = $data->bot;
        
        if (property_exists($data, 'system'))
            $this->system = $data->system;

        if (property_exists($data, 'mfa_enabled'))
            $this->two_factor_auth = $data->mfa_enabled;

        if (property_exists($data, 'locale'))
            $this->locale = $data->locale;

        if (property_exists($data, 'verified'))
            $this->verified_email = $data->verified;

        if (property_exists($data, 'email'))
            $this->email = $data->email;

        if (property_exists($data, 'flags'))
            $this->flags = $data->flags;

        if (property_exists($data, 'premium_type'))
            $this->premium_type = $data->premium_type;

        if (property_exists($data, 'public_flags'))
            $this->public_flags = $data->public_flags;
    }
}