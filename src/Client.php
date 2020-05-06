<?php
namespace DHP;

use DHPCore\MinimalDiscordClient;
use RestCord\DiscordClient as RestClient;

use DHP\Classes\Message;

class Client
{
    /**
     * @var MinimalDiscordClient
     */
    private $minimal_client;

    /**
     * @var RestClient
     */
    private $rest_client;

    public function __construct($token)
    {
        $this->minimal_client = new MinimalDiscordClient($token);

        $this->rest_client = new RestClient(['token' => $token]);

        $rest_client = &$this->rest_client;

        $this->minimal_client->on('MESSAGE_CREATE', function ($d) use ($rest_client) {
            $message = new Message($d, $rest_client);

            if ($message->content === 'ping')
                $message->reply('pong!');
        });

        $this->minimal_client->start_handling();
    }
}
