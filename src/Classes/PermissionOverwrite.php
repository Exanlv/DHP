<?php

declare(strict_types = 1);

namespace DHP\Classes;

class PermissionOverwrite
{

	public id $id;

	public string $type;

	public int $allow;

	public int $deny;

	public function __construct($data)
	{
		$this->id = $data->id;
		$this->type = $data->type;
		$this->allow = $data->allow;
		$this->deny = $data->deny;
	}

}
