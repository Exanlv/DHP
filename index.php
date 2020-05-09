<?php
require(__DIR__ . '/vendor/autoload.php');

use DHP\Classes\Channel;
use DHP\Classes\Message;
use DHP\Client;
use DHP\RestClient\Channel\Classes\EditChannelOptions;
use DHP\RestClient\Channel\Classes\EditMessageOptions;
use DHP\RestClient\Channel\Classes\SendMessageOptions;

$token = trim(file_get_contents('.token'));

$client = new Client($token);

$client->on('message', function (Message $message) {
    if ($message->content === 'ping') {
        $reply = new SendMessageOptions();
        $reply->content = 'Pong!';

        $message->reply($reply, function (Message $message) {
            $edit = new EditMessageOptions();
            $edit->content = 'Pang!';

            $message->edit($edit);
        });
    }

    if ($message->content === 'channel') {
        $message->channel(function (Channel $channel) {
            print_r($channel);
        });
    }

    if ($message->content === 'delete') {
        $message->delete(function () use ($message) {
            $reply = new SendMessageOptions();
            $reply->content = 'Message deleted <o/';
            
            $message->reply($reply);
        });
    }

    if ($message->content === 'edit') {
        $message->channel(function (Channel $channel) {
            $edit = new EditChannelOptions();
            $edit->name = 'Test ' . mt_rand(10000, 99999);

            $channel->edit($edit);
        });
    }

    if ($message->content === 'delete-channel') {
        $message->channel(function (Channel $channel) {
            // $channel->delete();
        });
    }
});

$client->start_handling();