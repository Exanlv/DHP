<?php

declare(strict_types = 1);

namespace DHP\Classes;

use DHP\RestClient\Client as RestClient;

class Role
{

	private RestClient $rest_client;

	public string $id;

	public string $name;

	public int $color;

	public bool $hoist;

	public int $position;

	public int $permissions;

	public bool $managed;

	public bool $mentionable;

	public function __construct($data, RestClient &$rest_client)
	{
		$this->rest_client = &$rest_client;

		$this->id = $data->id;

		$this->name = $data->name;

		$this->color = $data->color;

		$this->hoist = $data->hoist;

		$this->position = $data->position;

		$this->permissions = $data->permissions;

		$this->managed = $data->managed;

		$this->mentionable = $data->mentionable;
	}

}
