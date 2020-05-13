<?php
namespace DHP\RestClient\Channel;

use Closure;
use DHP\Classes\Channel;
use DHP\Classes\Invite;
use DHP\Classes\Message;
use DHP\RestClient\Channel\Classes\CreateChannelInviteOptions;
use DHP\RestClient\Channel\Classes\EditChannelOptions;
use DHP\RestClient\Channel\Classes\EditMessageOptions;
use DHP\RestClient\Channel\Classes\Emoji;
use DHP\RestClient\Channel\Classes\FetchMessagesOptions;
use DHP\RestClient\Channel\Classes\SendMessageOptions;
use DHP\RestClient\Client as RestClient;
use DHP\RestClient\Error;

class ChannelController
{
    
    /**
     * @var RestClient
     */
    private $rest_client;
    
    public function __construct(RestClient &$client)
    {
        $this->rest_client = &$client;
    }

    /**
     * @param string $channel_id
     * @param Closure $callback
     */
    public function get(string $channel_id, Closure $callback = null)
    {
        $uri = 'channels/' . $channel_id;

        $final_callback = $callback === null ? null : function ($error, $data) use ($callback) {
            $channel = $error === null ? new Channel($data->data, $this->rest_client) : null;

            $callback($error, $channel);
        };

        $this->rest_client->queue_request('get', $uri, null, [], $uri, $final_callback);
    }

    /**
     * @param string $channel_id,
     * @param EditChannelOptions $options
     * @param Closure $callback
     */
    public function edit(string $channel_id, EditChannelOptions $options, Closure $callback = null)
    {
        $uri = 'channels/' . $channel_id;

        $final_callback = $callback === null ? null : function ($error, $data) use ($callback) {
            $channel = $error === null ? new Channel($data->data, $this->rest_client) : null;
            
            $callback($error, $channel);
        };

        foreach ($options as $key => $option)
            if ($option === null)
                unset($options->{$key});

        $this->rest_client->queue_request('patch', $uri, $options, [], $uri, $final_callback);
    }

    /**
     * @param string $channel_id
     * @param Closure $callback
     */
    public function delete(string $channel_id, Closure $callback = null)
    {
        $uri = 'channels/' . $channel_id;

        $this->rest_client->queue_request('delete', $uri, null, [], $uri, $callback);
    }

    /**
     * @param string $channel_id
     * @param FetchMessagesOptions $options
     */
    public function fetch_messages(string $channel_id, FetchMessagesOptions $options)
    {

    }

    /**
     * @param string $channel_id
     * @param string $message_id
     */
    public function fetch_message(string $channel_id, string $message_id)
    {

    }

    /**
     * @param string $channel_id
     * @param SendMessageOptions $options
     * @param Closure $callback
     */
    public function send_message(string $channel_id, SendMessageOptions $options, Closure $callback = null)
    {
        $uri = 'channels/' . $channel_id . '/messages';

        $final_callback = $callback === null ? null : function ($error, $response) use ($callback) {
            $message = $error === null ? new Message($response->data, $this->rest_client) : null;

            $callback($error, $message);
        };

        $this->rest_client->queue_request('post', $uri, $options, [], $uri, $final_callback);
    }

    /**
     * @param string $channel_id
     * @param string $message_id
     * @param EditMessageOptions $options
     * @param Closure $callback
     */
    public function edit_message(string $channel_id, string $message_id, EditMessageOptions $options, Closure $callback = null)
    {
        $rate_limit_key = 'channels/' . $channel_id . '/messages';
        $uri = $rate_limit_key . '/' . $message_id;

        $final_callback = $callback === null ? null : function ($error, $response) use ($callback) {
            $message = $error === null ? new Message($response->data, $this->rest_client) : null;

            $callback($error, $message);
        };

        $this->rest_client->queue_request('patch', $uri, $options, [], $rate_limit_key, $final_callback);
    }

    /**
     * @param string $channel_id
     * @param string $message_id
     * @param Closure $callback
     */
    public function delete_message(string $channel_id, string $message_id, Closure $callback = null)
    {
        $rate_limit_key = 'channels/' . $channel_id . '/messages';
        $uri = $rate_limit_key . '/' . $message_id;

        $this->rest_client->queue_request('delete', $uri, null, [], $rate_limit_key, $callback, '204');
    }

    /**
     * @param string $channel_id
     * @param string $message_id
     * @param Emoji $emoji
     */
    public function add_reaction(string $channel_id, string $message_id, Emoji $emoji)
    {

    }

    /**
     * @param string $channel_id
     * @param string $message_id
     * @param Emoji $emoji
     */
    public function delete_reaction(string $channel_id, string $message_id, Emoji $emoji)
    {

    }

    /**
     * @param string $channel_id
     * @param string $message_id
     * @param Emoji $emoji
     */
    public function delete_user_reaction(string $channel_id, string $message_id, Emoji $emoji)
    {

    }

    /**
     * @param string $channel_id
     * @param string $message_id
     * @param Emoji $emoji
     */
    public function get_reactions(string $channel_id, string $message_id, Emoji $emoji)
    {

    }

    /**
     * @param string $channel_id
     * @param string $message_id
     */
    public function delete_all_reactions(string $channel_id, string $message_id)
    {

    }

    /**
     * @param string $channel_id
     * @param string $message_id
     */
    public function delete_all_reactions_of_type(string $channel_id, string $message_id)
    {

    }

    /**
     * @param string $channel_id
     * @param string[] $message_ids
     */
    public function bulk_delete_message(string $channel_id, array $message_ids)
    {

    }

    /**
     * @param string $channel_id
     * @param string $overwrite_id
     */
    public function edit_permissions(string $channel_id, string $overwrite_id)
    {

    }

    /**
     * @param string $channel_id
     * @param Closure $callback
     */
    public function get_invites(string $channel_id, Closure $callback = null)
    {
        $uri = 'channels/' . $channel_id . '/invites';

        $final_callback = $callback === null ? : function ($error, $data) use ($callback) {
            $invites = $error === null ? array_map(function ($invite) {
                return new Invite($invite, $this->rest_client);
            }, $data->data) : null;

            $callback($error, $invites);
        };

        $this->rest_client->queue_request('get', $uri, null, [], $uri, $final_callback);
    }

    /**
     * @param string $channel_id
     * @param CreateChannelInviteOptions $options
     * @param Closure $callback
     */
    public function create_invite(string $channel_id, CreateChannelInviteOptions $options, Closure $callback = null)
    {
        $uri = 'channels/' . $channel_id . '/invites';

        foreach ($options as $key => $value)
            if ($value === null)
                unset($options->$key);
        
        $final_callback = $callback === null ? null : function ($error, $data) use ($callback) {
            $invite = $error === null ? new Invite($data->data, $this->rest_client) : null;

            $callback($error, $invite);
        };

        $this->rest_client->queue_request('post', $uri, $options, [], $uri, $final_callback);
    }

    /**
     * @param string $channel_id
     * @param string $overwrite_id
     */
    public function delete_permission(string $channel_id, string $overwrite_id)
    {

    }

    /**
     * @param string $channel_id
     */
    public function trigger_typing_indicator(string $channel_id)
    {

    }

    /**
     * @param string $channel_id
     * @param Closure $callback
     */
    public function get_pinned_messages(string $channel_id, Closure $callback)
    {
        $uri = 'channels/' . $channel_id . '/pins';

        $final_callback = $callback === null ? null : function ($error, $data) use ($callback) {
            $pinned_messages = $error === null ? array_map(function ($d) {
                return new Message($d, $this->rest_client);
            }, $data->data) : null;

            $callback($pinned_messages);
        };

        $this->rest_client->queue_request('get', $uri, null, [], $uri, $final_callback);
    }

    /**
     * @param string $channel_id
     * @param string $message_id
     * @param Closure $callback
     */
    public function pin_message(string $channel_id, string $message_id, Closure $callback = null)
    {
        $rate_limit_key = 'channels/' . $channel_id . '/pins';
        $uri = $rate_limit_key . '/' . $message_id;

        $this->rest_client->queue_request('put', $uri, null, [], $rate_limit_key, $callback, '204');
    }

    /**
     * @param string $channel_id
     * @param string $message_id
     * @param Closure $callback
     */
    public function unpin_message(string $channel_id, string $message_id, Closure $callback = null)
    {
        $rate_limit_key = 'channels/' . $channel_id . '/pins';
        $uri = $rate_limit_key . '/' . $message_id;

        $this->rest_client->queue_request('delete', $uri, null, [], $rate_limit_key, $callback, '204');
    }
}