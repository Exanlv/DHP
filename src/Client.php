<?php
namespace DHP;

use DHPCore\MinimalDiscordClient;
use DHP\RestClient\Client as RestClient;

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

        $this->rest_client = new RestClient($token);

        $rest_client = &$this->rest_client;

        $this->minimal_client->on('HEARTBEAT', function () use (&$rest_client) {
            $rest_client->cleanup();
        });

        $this->minimal_client->on('TICK', function () use (&$rest_client) {
            $rest_client->tick();
        });

        $this->minimal_client->start_handling();
    }
}
