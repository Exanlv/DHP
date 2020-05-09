<?php
namespace DHP\Classes;

use Closure;
use DHP\Classes\User;
use DHP\Classes\PartialMember;
use DHP\Classes\Attachment;
use DHP\Classes\MentionedUser;

use DateTime;
use DateTimeZone;
use DHP\RestClient\Channel\Classes\EditMessageOptions;
use DHP\RestClient\Channel\Classes\SendMessageOptions;
use DHP\RestClient\Client as RestClient;

class Message
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $channel_id;

    /**
     * @var string
     */
    public $guild_id;

    /**
     * @var User
     */
    public $user;
    
    /**
     * @var PartialMember
     */
    public $partial_member;

    /**
     * @var string
     */
    public $content;

    /**
     * @var DateTime
     */
    public $sent_at;

    /**
     * @var DateTime
     */
    public $edited_at;
    
    /**
     * @var boolean
     */
    public $tts;

    /**
     * @var boolean
     */
    public $mentioned_everyone;

    /**
     * @var MentionedUser[]
     */
    public $mentioned_users;

    /**
     * @var string[]
     */
    public $mentioned_roles;

    /**
     * @var string[]
     */
    public $mentioned_channels;

    /**
     * @var Attachment[]
     */
    public $attachments;

    /**
     * @var integer|string
     */
    public $nonce;

    /**
     * @var boolean
     */
    public $pinned;

    /**
     * @var string
     */
    public $webhook_id;

    /**
     * @var string
     */
    public $type;

    /**
     * @var RestClient
     */
    private $rest_client;

    /**
     * @todo
     *  - embeds
     *  - reactions?
     *  - activity?
     *  - application?
     *  - message_reference?
     *  - flags?
     *  - webhook user
     *  - type enum
     */

    public function __construct($data, RestClient &$rest_client)
    {
        $this->rest_client = &$rest_client;

        $utc_date_time_zone = new DateTimeZone('UTC');

        $this->id = $data->id;
        $this->channel_id = $data->channel_id;
        
        if (property_exists($data, 'guild_id'))
            $this->guild_id = $data->guild_id;
        
        $this->user = new User($data->author);
        
        if (property_exists($data, 'member'))
            $this->partial_member = new PartialMember($data->member);
        
        $this->content = $data->content;
        $this->sent_at = new DateTime($data->timestamp, $utc_date_time_zone);
        $this->edited_at = new DateTime($data->edited_timestamp, $utc_date_time_zone);
        $this->tts = $data->tts;
        $this->mentioned_everyone = $data->mention_everyone;
        $this->mentioned_users = [];

        foreach ($data->mentions as $mentioned_user_data)
            $this->mentioned_users[] = new MentionedUser($mentioned_user_data);

        $this->mentioned_roles = $data->mention_roles;

        if (property_exists($data, 'mention_channels'))
            $this->mentioned_channels = $data->mention_channels;

        $this->attachments = [];

        foreach ($data->attachments as $attachment_data)
            $this->attachments[] = $attachment_data;
        
        if (property_exists($data, 'nonce'))
            $this->nonce = $data->nonce;
        
        $this->pinned = $data->pinned;

        if (property_exists($data, 'webhook_id'))
            $this->webhook_id = $data->webhook_id;
        
        $this->type = [
            'DEFAULT',
            'RECIPIENT_ADD',
            'RECIPIENT_REMOVE',
            'CALL',
            'CHANNEL_NAME_CHANGE',
            'CHANNEL_ICON_CHANGE',
            'CHANNEL_PINNED_MESSAGE',
            'GUILD_MEMBER_JOIN',
            'USER_PREMIUM_GUILD_SUBSCRIPTION',
            'USER_PREMIUM_GUILD_SUBSCRIPTION_TIER_1',
            'USER_PREMIUM_GUILD_SUBSCRIPTION_TIER_2',
            'USER_PREMIUM_GUILD_SUBSCRIPTION_TIER_3',
            'CHANNEL_FOLLOW_ADD',
            'GUILD_DISCOVERY_DISQUALIFIED',
            'GUILD_DISCOVERY_REQUALIFIED',
        ][$data->type];
    }

    public function reply(SendMessageOptions $options, Closure $callback = null)
    {
        $this->rest_client->channel_controller->send_message(
            $this->channel_id,
            $options,
            $callback
        );
    }

    public function edit(EditMessageOptions $options, Closure $callback = null)
    {
        $this->rest_client->channel_controller->edit_message(
            $this->channel_id,
            $this->id,
            $options,
            $callback
        );
    }

    public function channel(Closure $callback)
    {
        $this->rest_client->channel_controller->get($this->channel_id, $callback);
    }

    public function delete(Closure $callback = null)
    {
        $this->rest_client->channel_controller->delete_message($this->channel_id, $this->id, $callback);
    }
}