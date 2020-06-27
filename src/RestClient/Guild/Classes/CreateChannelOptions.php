<?php

declare(strict_types = 1);

namespace DHP\RestClient\Guild\Classes;

class CreateChannelOptions
{

	public string $name;

	public ?int $type;

	public ?string $topic;

	public ?int $bitrate;

	public ?int $user_limit;

	public ?int $rate_limit_user;

	public ?int $position;

	/**
	 * @var \DHP\Classes\PermissionOverwrite[]
	 */
	public ?array $permission_overwrites;

	public ?string $parent_id;

	public ?bool $nsfw;

}
