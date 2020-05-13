<?php
require(__DIR__ . '/vendor/autoload.php');

use DHP\Classes\Channel;
use DHP\Classes\Embed;
use DHP\Classes\EmbedField;
use DHP\Classes\Invite;
use DHP\Classes\Message;
use DHP\Client;
use DHP\RestClient\Channel\Classes\CreateChannelInviteOptions;
use DHP\RestClient\Channel\Classes\EditChannelOptions;
use DHP\RestClient\Channel\Classes\EditMessageOptions;
use DHP\RestClient\Channel\Classes\SendMessageOptions;
use DHP\RestClient\Error;

$token = trim(file_get_contents('.token'));

$client = new Client($token);

$client->on('message', function (Message $message) {
    if ($message->content === 'ping') {
        $reply = new SendMessageOptions();
        $reply->content = 'Pong!';

        $message->reply($reply, function ($err, $message) {
            if ($err !== null)
                print_r($err);

            $edit = new EditMessageOptions();
            $edit->content = 'Pang!';

            $message->edit($edit);
        });
    }

    if ($message->content === 'ping-embed') {
        $reply = new SendMessageOptions();
        $reply->embed = new Embed();

        $reply->embed->author->name = $message->user->username;
        $reply->embed->set_color_hex('0000FF');

        $embed_field = new EmbedField();
        $embed_field->name = 'Ping!';
        $embed_field->value = 'Pong!';

        $reply->embed->fields[] = $embed_field;

        $message->reply($reply, function ($err, $message) {
            print_r($message);
        });
    }

    if ($message->content === 'channel') {
        $message->channel(function ($err, $channel) {
            print_r($channel);
        });
    }

    if ($message->content === 'delete') {
        $message->delete(function ($err) use ($message) {
            $reply = new SendMessageOptions();
            $reply->content = 'Message deleted <o/';
            
            $message->reply($reply);
        });
    }

    if ($message->content === 'edit') {
        $message->channel(function ($err, $channel) {
            $edit = new EditChannelOptions();
            $edit->name = 'Test ' . mt_rand(10000, 99999);

            $channel->edit($edit);
        });
    }

    if ($message->content === 'delete-channel') {
        $message->channel(function ($err, $channel) {
            // $channel->delete();
        });
    }

    if ($message->content === 'pin') {
        $message->pin();
    }

    if ($message->content === 'unpin') {
        $message->pin(function ($err) use ($message) {
            $message->unpin();
        });
    }

    if ($message->content === 'get-pins') {
        $message->channel(function ($err, $channel) {
            $channel->get_pinned_messages(function ($err, $messages) {
                foreach ($messages as $pinned_message) {
                    $reply = new SendMessageOptions();
                    $reply->content = $pinned_message->id;
                    
                    $pinned_message->reply($reply);
                }
            });
        });
    }

    if ($message->content === 'invite') {
        $message->channel(function ($err, $channel) {
            $channel->create_invite(new CreateChannelInviteOptions(), function ($err, $invite) {
                print_r($invite);
            });
        });
    }

    if ($message->content === 'invites') {
        $message->channel(function ($err, $channel) {
            $channel->get_invites(function ($err, $invites) {
                print_r($invites);
            });
        });
    }
});

$client->start_handling();