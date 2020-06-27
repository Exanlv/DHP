<?php

declare(strict_types = 1);

namespace DHP\RestClient\Guild\Classes;

class GetGuildPruneCountOptions
{

	public int $days;

	/**
	 * @var string[]
	 */
	public array $include_roles;

}
