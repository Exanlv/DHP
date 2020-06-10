<?php

declare(strict_types = 1);

namespace DHP\RestClient\Channel\Classes;

class AllowedMentions
{

	/**
	 * @var string[]
	 */
	public array $parse = ['users', 'roles', 'everyone'];

	/**
	 * @var string[]
	 */
	public array $users;

}
