<?php

declare(strict_types = 1);

namespace DHP\Classes;

class EmbedField
{

	public string $name;

	public string $value;

	public bool $inline;

	public function __construct($data = null)
	{
		if ($data !== null) {
			if (property_exists($data, 'name'))
				$this->name = $data->name;

			if (property_exists($data, 'value'))
				$this->value = $data->value;

			if (property_exists($data, 'inline'))
				$this->inline = $data->inline;
		}
	}

}
