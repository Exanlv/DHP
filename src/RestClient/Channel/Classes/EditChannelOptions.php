<?php

declare(strict_types = 1);

namespace DHP\RestClient\Channel\Classes;

class EditChannelOptions
{

	public string $name;

	public int $type;

	public int $position;

	public bool $nsfw;

	public int $rate_limit_per_user;

	public int $bitrate;

	public int $user_limit;

	/**
	 * @var \DHP\RestClient\Channel\Classes\PermissionOverwrite[] public $permission_overwrites
	 */
	public array $permission_overwrites;

	public string $parent_id;

}
