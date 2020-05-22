<?php

declare(strict_types = 1);

namespace DHP\Classes;

use DHP\RestClient\Client as RestClient;

class Emoji
{

	private RestClient $rest_client;

	public string $id;

	public string $name;

	/**
	 * @var \DHP\Classes\Role[]
	 */
	public array $roles;

	public User $user;

	public bool $require_colons;

	public bool $managed;

	public bool $animated;

	public bool $available;

	public function __construct($data, RestClient &$rest_client)
	{
		$this->rest_client = &$rest_client;

		$this->id = $data->id;

		$this->name = $data->name;

		if (property_exists($data, 'roles'))
			foreach ($data->roles as $role)
				$this->roles[] = new Role($role, $this->rest_client);

		if (property_exists($data, 'user'))
			$this->user = new User($data->user, $this->rest_client);

		if (property_exists($data, 'require_colons'))
			$this->require_colons = $data->require_colons;

		if (property_exists($data, 'managed'))
			$this->managed = $data->managed;

		if (property_exists($data, 'animated'))
			$this->animated = $data->animated;

		if (property_exists($data, 'available'))
			$this->available = $data->available;
	}

	public function url_identifier()
	{
		return urlencode($this->name . ':' . $this->id);
	}

}
