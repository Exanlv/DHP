<?php

declare(strict_types = 1);

namespace DHP\Classes;

use DHP\RestClient\Client as RestClient;
use DateTime;
use DateTimeZone;

class Member
{

	private RestClient $rest_client;

	public User $user;

	public string $nickname;

	/**
	 * @var \DHP\Classes\Role[]
	 */
	public array $roles = [];

	public DateTime $joined_at;

	public DateTime $premium_since;

	public bool $deaf;

	public bool $mute;

	public function __construct($data, RestClient &$rest_client)
	{
		$this->rest_client = &$rest_client;

		if (property_exists($data, 'user'))
			$this->user = new User($data->user, $this->rest_client);

		if (property_exists($data, 'nick'))
			$this->nickname = $data->nick;

		foreach ($this->roles as $role)
			$this->roles[] = new Role($role, $this->rest_client);

		$utc_timezone = new DateTimeZone('UTC');

		$this->joined_at = new DateTime($data->joined_at, $utc_timezone);

		if (property_exists($data, 'premium_since'))
			$this->premium_since = new DateTime($data->premium_since, $utc_timezone);

		$this->deaf = $data->deaf;

		$this->mute = $data->mute;
	}

}
