<?php

declare(strict_types = 1);

namespace DHP\RestClient\Guild\Classes;

class EditGuildMemberOptions
{

	public ?string $nick;

	/**
	 * @var string[]
	 */
	public ?array $roles;

	public ?bool $mute;

	public ?bool $deaf;

	public ?string $channel_id;

}
