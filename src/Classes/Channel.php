<?php

namespace DHP\Classes;

use Closure;
use DHP\RestClient\Channel\Classes\EditChannelOptions;
use DHP\RestClient\Client as RestClient;

class Channel
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
    public $type;

    /**
     * @var string
     */
    public $guild_id;

    /**
     * @var string
     */
    public $position;

    /**
     * @var PermissionOverwrite[]
     */
    public $permission_overwrites = [];

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $topic;

    /**
     * @var boolean
     */
    public $nsfw;

    /**
     * @var string
     */
    public $last_message_id;

    /**
     * @var int
     */
    public $bitrate;

    /**
     * @var int
     */
    public $user_limit;

    /**
     * @var int
     */
    public $user_rate_limit;

    /**
     * @var User[]
     */
    public $recipients = [];

    /**
     * @var string
     */
    public $icon;

    /**
     * @var string
     */
    public $owner_id;

    /**
     * @var string
     */
    public $application_id;

    /**
     * @var string
     */
    public $parent_id;

    /**
     * @var string
     */
    public $last_pin_timestamp;

    public function __construct($data, RestClient &$rest_client)
    {
        $this->rest_client = &$rest_client;

        $this->id = $data->id;
        $this->type = [
            'GUILD_TEXT',
            'DM',
            'GUILD_VOICE',
            'GROUP_DM',
            'GUILD_CATEGORY',
            'GUILD_NEWS',
            'GUILD_STORE'
        ][$data->type];

        if (property_exists($data, 'guild_id'))
            $this->guild_id = $data->guild_id;
        
        if (property_exists($data, 'position'))
            $this->position = $data->position;

        if (property_exists($data, 'permission_overwrites'))
            foreach ($data->permission_overwrites as $permission_overwrite)
                $this->permission_overwrites[] = new PermissioOverwrite($permission_overwrite);

        if (property_exists($data, 'name'))
            $this->name = $data->name;

        if (property_exists($data, 'topic'))
            $this->topic = $data->topic;
        
        if (property_exists($data, 'nsfw'))
            $this->nsfw = $data->nsfw;

        if (property_exists($data, 'last_message_id'))
            $this->last_message_id = $data->last_message_id;

        if (property_exists($data, 'bitrate'))
            $this->bitrate = $data->bitrate;

        if (property_exists($data, 'user_limit'))
            $this->user_limit = $data->user_limit;

        if (property_exists($data, 'rate_limit_per_user'))
            $this->rate_limit_per_user = $data->rate_limit_per_user;

        if (property_exists($data, 'recipients'))
            foreach ($data->recipients as $user)
                $this->recipients[] = new User($user);

        if (property_exists($data, 'icon'))
            $this->icon = $data->icon;

        if (property_exists($data, 'owner_id'))
            $this->owner_id = $data->owner_id;

        if (property_exists($data, 'application_id'))
            $this->application_id = $data->application_id;

        if (property_exists($data, 'parent_id'))
            $this->parent_id = $data->parent_id;

        if (property_exists($data, 'last_pin_timestamp'))
            $this->last_pin_timestamp = $data->last_pin_timestamp;
    }

    public function edit(EditChannelOptions $options, Closure $callback = null)
    {
        $this->rest_client->channel_controller->edit($this->id, $options, $callback);
    }

    public function delete(Closure $callback = null)
    {
        $this->rest_client->channel_controller->delete($this->id, $callback);
    }
}