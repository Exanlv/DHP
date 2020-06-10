<?php

declare(strict_types = 1);

namespace DHP;

use DHP\Classes\Message;
use DHP\RestClient\Client as RestClient;
use DHPCore\MinimalDiscordClient;

class Client extends \EventEmitter\EventEmitter
{

	private MinimalDiscordClient $minimal_client;

	private RestClient $rest_client;

	public function __construct(string $token)
	{
		$this->minimal_client = new MinimalDiscordClient($token);

		$this->rest_client = new RestClient($token);

		$this->minimal_client->on('HEARTBEAT', function (): void {
			$this->rest_client->cleanup();
		});

		$this->minimal_client->on('TICK', function (): void {
			$this->rest_client->tick();
		});

		$this->minimal_client->on('MESSAGE_CREATE', function ($data): void {
			$this->emit('message', (new Message($data, $this->rest_client)));
		});

		// $this->minimal_client->on('GUILD_CREATE', function ($data) {
			// print_r(new Guild($data, $this->rest_client));
		// });
	}

	public function start_handling(): void
	{
		$this->minimal_client->start_handling();
	}

}
