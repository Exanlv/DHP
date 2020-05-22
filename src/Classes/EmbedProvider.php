<?php

declare(strict_types = 1);

namespace DHP\Classes;

use stdClass;

class EmbedProvider
{

	public string $name;

	public string $url;

	public function __construct(?stdClass $data = null)
	{
		if ($data !== null) {
			if (property_exists($data, 'name'))
				$this->name = $data->name;

			if (property_exists($data, 'url'))
				$this->url = $data->url;
		}
	}

}
