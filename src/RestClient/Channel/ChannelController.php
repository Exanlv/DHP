<?php
namespace DHP\RestClient\Channel;

use Closure;
use DHP\Classes\Message;
use DHP\RestClient\Channel\Classes\EditMessageOptions;
use DHP\RestClient\Channel\Classes\Emoji;
use DHP\RestClient\Channel\Classes\FetchMessagesOptions;
use DHP\RestClient\Channel\Classes\SendMessageOptions;
use DHP\RestClient\Client as RestClient;

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
     */
    public function get(string $channel_id)
    {

    }

    /**
     * @param string $channel_id,
     * @param EditMessageOptions $options
     */
    public function edit(string $channel_id, EditMessageOptions $options)
    {

    }

    /**
     * @param string $channel_id
     */
    public function delete(string $channel_id)
    {

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
     */
    public function send_message(string $channel_id, SendMessageOptions $options, Closure $callback = null)
    {
        $uri = 'channels/' . $channel_id . '/messages';

        $final_callback = $callback === null ? null : function ($response) use ($callback) {
            $message = new Message($response->data, $this->rest_client);

            $callback($message);
        };

        $this->rest_client->queue_request('post', $uri, $options, [], $uri, $final_callback);
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
     * @param string $message_id
     */
    public function delete_message(string $channel_id, string $message_id)
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
     */
    public function get_invites(string $channel_id)
    {

    }

    /**
     * @param string $channel_id
     */
    public function create_invite(string $channel_id)
    {

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
     */
    public function get_pinned_messages(string $channel_id)
    {

    }

    /**
     * @param string $channel_id
     * @param string $message_id
     */
    public function pin_message(string $channel_id, string $message_id)
    {

    }

    /**
     * @param string $channel_id
     * @param string $message_ids
     */
    public function unpin_message(string $channel_id, string $message_id)
    {

    }
}