<?php

declare(strict_types = 1);

namespace DHP\Classes;

class EmbedFooter
{

	public string $text;

	public string $icon_url;

	public string $proxy_icon_url;

	public function __construct($data = null)
	{
		if ($data !== null) {
			if (property_exists($data, 'text'))
				$this->text = $data->text;

			if (property_exists($data, 'icon_url'))
				$this->icon_url = $data->icon_url;

			if (property_exists($data, 'proxy_icon_url'))
				$this->proxy_icon_url = $data->proxy_icon_url;
		}
	}

}
