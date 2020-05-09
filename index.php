<?php
require(__DIR__ . '/vendor/autoload.php');

use DHP\Classes\Message;
use DHP\Client;
use DHP\RestClient\Channel\Classes\SendMessageOptions;

$token = trim(file_get_contents('.token'));

$client = new Client($token);

$client->on('message', function (Message $message) {
    if ($message->content === 'ping') {
        $reply = new SendMessageOptions();
        $reply->content = 'Pong!';

        $message->reply($reply);
    }
});

$client->start_handling();