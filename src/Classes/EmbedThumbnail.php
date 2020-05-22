<?php

declare(strict_types = 1);

namespace DHP\Classes;

class EmbedThumbnail
{

	public string $url;

	public string $proxy_url;

	public int $height;

	public int $width;

	public function __construct($data = null)
	{
		if ($data !== null) {
			if (property_exists($data, 'url'))
				$this->url = $data->url;

			if (property_exists($data, 'proxy_url'))
				$this->proxy_url = $data->proxy_url;

			if (property_exists($data, 'width'))
				$this->width = $data->width;

			if (property_exists($data, 'height'))
				$this->height = $data->height;
		}
	}

}
