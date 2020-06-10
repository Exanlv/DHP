<?php

declare(strict_types = 1);

namespace DHP\RestClient;

use stdClass;

class Error
{

	public string $code;

	public stdClass $data;

	public function __construct(string $code, stdClass $data)
	{
		$this->code = $code;

		$this->data = $data;
	}

}
