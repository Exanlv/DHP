<?php

declare(strict_types = 1);

namespace DHP\RestClient\Guild\Classes;

class CreateGuildOptions
{

	public ?string $name;

	public ?string $region;

	public ?string $icon;

	public ?int $verification_level;

	public ?int $default_message_notifications;

	public ?int $explicit_content_filter;

	/**
	 * @var \DHP\Classes\Role[]
	 */
	public ?array $roles;

	/**
	 * @var \DHP\Classes\Channel[]
	 */
	public ?array $channels;

	public ?string $afk_channel_id;

	public ?int $afk_timeout;

	public ?string $system_channel_id;

}
