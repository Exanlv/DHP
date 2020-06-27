<?php

declare(strict_types = 1);

namespace DHP\RestClient\Guild\Classes;

class EditGuildRoleOptions
{

	public ?string $name;

	public ?int $permissions;

	public ?int $color;

	public ?bool $hoist;

	public ?bool $mentionable;

}
