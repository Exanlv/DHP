<?php

namespace DHP\Classes;

use DateTime;
use DHP\RestClient\Client as RestClient;

class Guild
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
     * @var icon
     */
    public $icon;

    /**
     * @var string
     */
    public $splash;

    /**
     * @var string
     */
    public $discovery_splash;
    
    /**
     * @var boolean
     */
    public $owner;

    /**
     * @var string
     */
    public $owner_id;

    /**
     * @var int
     */
    public $permissions;

    /**
     * @var string
     */
    public $region;

    /**
     * @var integer
     */
    public $afk_channel_id;

    /**
     * @var int
     */
    public $afk_timeout;

    /**
     * @var boolean
     */
    public $embed_enabled;

    /**
     * @var string
     */
    public $embed_channel_id;

    /**
     * @var int
     */
    public $verification_level;

    /**
     * @var int
     */
    public $default_message_notification;

    /**
     * @var int
     */
    public $explicit_content_filter;

    /**
     * @var Role[]
     */
    public $roles = [];

    /**
     * @var Emoji[]
     */
    public $emojis = [];

    /**
     * @var string[]
     */
    public $features;

    /**
     * @var int
     */
    public $mfa_level;

    /**
     * @var string
     */
    public $application_id;

    /**
     * @var boolean
     */
    public $widget_enabled;

    /**
     * @var string
     */
    public $widget_channel_id;

    /**
     * @var string
     */
    public $system_channel_id;

    /**
     * @var int
     */
    public $system_channel_flags;

    /**
     * @var int
     */
    public $rules_channel_id;

    /**
     * @var DateTime
     */
    public $joined_at;

    /**
     * @var boolean
     */
    public $large;

    /**
     * @var boolean
     */
    public $unavailable;

    /**
     * @var int
     */
    public $member_count;

    /**
     * @var VoiceState[]
     */
    public $voice_state = [];

    /**
     * @var Member[]
     */
    public $members = [];

    /**
     * @var Channel[]
     */
    public $channels = [];

    /**
     * @var PrecenseUpdate[]
     */
    public $presences;

    /**
     * @var int
     */
    public $max_presences;

    /**
     * @var int
     */
    public $max_members;

    /**
     * @var string
     */
    public $vanity_url_code;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $banner;

    /**
     * @var integer
     */
    public $premium_tier;

    /**
     * @var int
     */
    public $premium_subscription_count;
    
    /**
     * @var string
     */
    public $preferred_locale;

    /**
     * @var string
     */
    public $public_updates_channel_id;

    /**
     * @var int
     */
    public $approximate_member_count;

    /**
     * @var int
     */
    public $approximate_presence_count;

    public function __construct($data = null, RestClient &$rest_client)
    {
        $this->rest_client = &$rest_client;
        
        $this->id = $data->id;

        $this->name = $data->name;

        if (property_exists($data, 'icon'))
            $this->icon = $data->icon;

        $this->splash = $data->splash;

        if (property_exists($data, 'owner'))
            $this->owner = $data->owner;

        if (property_exists($data, 'owner_id'))
            $this->owner_id = $data->owner_id;

        if (property_exists($data, 'permissions'))
            $this->permissions = $data->permissions;

        if (property_exists($data, 'region'))
            $this->region = $data->region;

        if (property_exists($data, 'afk_channel_id'))
            $this->afk_channel_id = $data->afk_channel_id;

        if (property_exists($data, 'afk_timeout'))
            $this->afk_timeout = $data->afk_timeout;

        if (property_exists($data, 'embed_enabled'))
            $this->embed_enabled = $data->embed_enabled;
        
        if (property_exists($data, 'embed_channel_id'))
            $this->embed_channel_id = $data->embed_channel_id;
        
        $this->verification_level = $data->verification_level;

        if (property_exists($data, 'default_message_notification'))
            $this->default_message_notification = $data->default_message_notification;

        if (property_exists($data, 'explicit_content_filter'))
            $this->explicit_content_filter = $data->explicit_content_filter;

        if (property_exists($data, 'roles'))
            foreach ($data->roles as $role)
                $this->roles[] = new Role($role, $this->rest_client);
        
        if (property_exists($data, 'emojis'))
            foreach ($data->emojis as $emoji)
                $this->roles[] = new Emoji($emoji, $this->rest_client);

        $this->features = $data->features;

        if (property_exists($data, 'mfa_level'))
            $this->mfa_level = $data->mfa_level;

        if (property_exists($data, 'application_id'))
            $this->application_id = $data->application_id;

        if (property_exists($data, 'widget_enabled'))
            $this->widget_enabled = $data->widget_enabled;

        if (property_exists($data, 'widget_channel_id'))
            $this->widget_channel_id = $data->widget_channel_id;

        if (property_exists($data, 'system_channel_id'))
            $this->system_channel_id = $data->system_channel_id;

        if (property_exists($data, 'system_channel_flags'))
            $this->system_channel_flags = $data->system_channel_flags;

        if (property_exists($data, 'rules_channel_id'))
            $this->rules_channel_id = $data->rules_channel_id;

        if (property_exists($data, 'joined_at'))
            $this->joined_at = new DateTime($data->joined_at);

        if (property_exists($data, 'large'))
            $this->large = $data->large;

        if (property_exists($data, 'unavailable'))
            $this->unavailable = $data->unavailable;

        if (property_exists($data, 'member_count'))
            $this->member_count = $data->member_count;

        if (property_exists($data, 'voice_states'))
            foreach ($data->voice_states as $voice_state)
                $this->voice_states[] = new VoiceState($voice_state);

        if (property_exists($data, 'members'))
            foreach ($data->members as $member)
                $this->members[] = new Member($member, $this->rest_client);

        if (property_exists($data, 'channels'))
            foreach ($data->channels as $channel)
                $this->channels[] = new Channel($channel, $this->rest_client);

        if (property_exists($data, 'presences'))
            $this->presences = $data->presences;

        if (property_exists($data, 'max_presences'))
            $this->max_presences = $data->max_presences;

        if (property_exists($data, 'max_members'))
            $this->max_members = $data->max_members;

        $this->vanity_url_code = $data->vanity_url_code;

        $this->description = $data->description;

        $this->banner = $data->banner;

        if (property_exists($data, 'premium_tier'))
            $this->premium_tier = $data->premium_tier;

        if (property_exists($data, 'premium_subscription_count'))
            $this->premium_subscription_count = $data->premium_subscription_count;

        if (property_exists($data, 'preferred_locale'))
            $this->preferred_locale = $data->preferred_locale;

        if (property_exists($data, 'public_updates_channel_id'))
            $this->public_updates_channel_id = $data->public_updates_channel_id;

        if (property_exists($data, 'approximate_member_count'))
            $this->approximate_member_count = $data->approximate_member_count;

        if (property_exists($data, 'approximate_presence_count'))
            $this->approximate_presence_count = $data->approximate_presence_count;
    }
}