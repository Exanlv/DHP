<?php
require(__DIR__ . '/vendor/autoload.php');

use DHP\Classes\Channel;
use DHP\Classes\Message;
use DHP\Client;
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
});

$client->start_handling();