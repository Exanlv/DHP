<?php

declare(strict_types = 1);

namespace DHP\Classes;

class EmbedAuthor
{

	public string $name;

	public string $url;

	public string $icon_url;

	public int $proxy_icon_url;

	public function __construct($data = null)
	{
		if ($data !== null) {
			if (property_exists($data, 'name'))
				$this->name = $data->name;

			if (property_exists($data, 'url'))
				$this->url = $data->url;

			if (property_exists($data, 'icon_url'))
				$this->icon_url = $data->icon_url;

			if (property_exists($data, 'proxy_icon_url'))
				$this->proxy_icon_url = $data->proxy_icon_url;
		}
	}

}
