<?php
namespace DHP;

use DHP\Classes\Guild;
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
        
        $this->minimal_client->on('HEARTBEAT', function () {
            $this->rest_client->cleanup();
        });

        $this->minimal_client->on('TICK', function () {
            $this->rest_client->tick();
        });

        $this->minimal_client->on('MESSAGE_CREATE', function ($data) {
            $this->emit('message', (new Message($data, $this->rest_client)));
        });

        // $this->minimal_client->on('GUILD_CREATE', function ($data) {
            // print_r(new Guild($data, $this->rest_client));
        // });
    }

    public function start_handling() {
        $this->minimal_client->start_handling();
    }
}
