<?php

declare(strict_types = 1);

namespace DHP\RestClient\Guild\Classes;

class AddGuildMemberOptions
{

	public string $access_token;

	public ?string $nick;

	/**
	 * @var string[]
	 */
	public ?array $roles;

	public ?bool $mute;

	public ?bool $deaf;

}
