<?php
namespace DHP\RestClient\Channel;

use DHP\RestClient\Channel\Classes\EditMessageOptions;
use DHP\RestClient\Channel\Classes\Emoji;
use DHP\RestClient\Channel\Classes\FetchMessagesOptions;
use DHP\RestClient\Channel\Classes\SendMessageOptions;
use DHP\RestClient\Client;

class ChannelRestClient extends Client
{
    public function get(string $channel_id)
    {

    }

    public function edit(string $channel_id, EditMessageOptions $options)
    {

    }

    public function delete(string $channel_id)
    {

    }

    public function fetch_messages(string $channel_id, FetchMessagesOptions $options)
    {

    }

    public function fetch_message(string $channel_id, string $message_id)
    {

    }

    public function send_message(string $channel_id, SendMessageOptions $options)
    {

    }

    public function add_reaction(string $channel_id, string $message_id, Emoji $emoji)
    {

    }

    public function delete_reaction(string $channel_id, string $message_id, Emoji $emoji)
    {

    }

    public function delete_user_reaction(string $channel_id, string $message_id, Emoji $emoji)
    {

    }

    public function get_reactions(string $channel_id, string $message_id, Emoji $emoji)
    {

    }

    public function delete_all_reactions(string $channel_id, string $message_id)
    {

    }

    public function delete_all_reactions_of_type(string $channel_id, string $message_id)
    {

    }

    public function delete_message(string $channel_id, string $message_id)
    {

    }

    public function bulk_delete_message(string $channel_id, string $messages)
    {

    }

    public function edit_permissions(string $channel_id, string $overwrite_id)
    {

    }

    public function get_invites(string $channel_id)
    {

    }

    public function create_invite(string $channel_id)
    {

    }

    public function delete_permission(string $channel_id, string $overwrite_id)
    {

    }

    public function trigger_typing_indicator(string $channel_id)
    {

    }

    public function get_pinned_messages(string $channel_id)
    {

    }

    public function pin_message(string $channel_id, string $message_id)
    {

    }

    public function unpin_message(string $channel_id, string $message_id)
    {

    }
}