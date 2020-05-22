<?php

declare(strict_types = 1);

namespace DHP\RestClient\Channel\Classes;

class CreateChannelInviteOptions
{

	public int $max_age;

	public int $max_users;

	public bool $temporary;

	public bool $unique;

	public string $target_user;

	public int $target_user_type;

}
