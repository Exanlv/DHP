<?php

declare(strict_types = 1);

namespace DHP\RestClient\Guild\Classes;

class StartGuildPruneOptions
{

	public int $days;

	public bool $compute_prune_count;

	/**
	 * @var string[]
	 */
	public array $include_roles;

}
