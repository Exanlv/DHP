<?php

declare(strict_types = 1);

namespace DHP\Classes;

use stdClass;

class EmbedVideo
{

	public string $url;

	public int $height;

	public int $width;

	public function __construct(?stdClass $data = null)
	{
		if ($data !== null) {
			if (property_exists($data, 'url'))
				$this->url = $data->url;

			if (property_exists($data, 'width'))
				$this->width = $data->width;

			if (property_exists($data, 'height'))
				$this->height = $data->height;
		}
	}

}
