<?php

declare(strict_types = 1);

namespace DHP\Classes;

use DateTime;
use DateTimeZone;

class PartialMember
{

	public string $nickname;

	/**
	 * @var array
	 */
	public array $roles;

	public DateTime $joined_at;

	public DateTime $premium_since;

	public bool $deaf;

	public bool $mute;

	public function __construct($data)
	{
		$utc_time_zone = new DateTimeZone('UTC');

		if (property_exists($data, 'nick'))
			$this->nickname = $data->nick;

		$this->roles = $data->roles;
		$this->joined_at = new DateTime($data->joined_at, $utc_time_zone);

		if (property_exists($data, 'premium_since'))
			$this->premium_since = new DateTime($data->premium_since, $utc_time_zone);

		$this->deaf = $data->deaf;
		$this->mute = $data->mute;
	}

}
