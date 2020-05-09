<?php
namespace DHP;

use DHP\Classes\Message;
use DHP\RestClient\Channel\ChannelRestClient;
use DHP\RestClient\Channel\Classes\SendMessageOptions;
use DHPCore\MinimalDiscordClient;
use DHP\RestClient\Client as RestClient;
use EventEmitter\EventEmitter;

class Client extends EventEmitter
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

        $this->rest_client = new RestClient($token);
        
        $rest_client = &$this->rest_client;

        $this->minimal_client->on('HEARTBEAT', function () use (&$rest_client) {
            $rest_client->cleanup();
        });

        $this->minimal_client->on('TICK', function () use (&$rest_client) {
            $rest_client->tick();
        });

        $discord_client = &$this;

        $this->minimal_client->on('MESSAGE_CREATE', function ($data) use (&$discord_client, &$rest_client) {
            $discord_client->emit('message', (new Message($data, $rest_client)));
        });
    }

    public function start_handling() {
        $this->minimal_client->start_handling();
    }
}
