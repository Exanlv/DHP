<?php

declare(strict_types = 1);

namespace DHP\Classes;

use DateTime;
use DateTimeZone;
use stdClass;

class PartialMember
{

	public string $nickname;

	/**
	 * @var \DHP\Classes\Role[]
	 */
	public array $roles;

	public DateTime $joined_at;

	public DateTime $premium_since;

	public bool $deaf;

	public bool $mute;

	public function __construct(stdClass $data)
	{
		$utc_time_zone = new DateTimeZone('UTC');

		if (property_exists($data, 'nick') && $data->nick !== null)
			$this->nickname = $data->nick;

		$this->roles = $data->roles;
		$this->joined_at = new DateTime($data->joined_at, $utc_time_zone);

		if (property_exists($data, 'premium_since') && $data->premium_since !== null)
			$this->premium_since = new DateTime($data->premium_since, $utc_time_zone);

		$this->deaf = $data->deaf;
		$this->mute = $data->mute;
	}

}
