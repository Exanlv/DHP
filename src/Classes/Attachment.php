<?php

declare(strict_types = 1);

namespace DHP\Classes;

class Attachment
{

	public string $id;

	public string $filename;

	public int $size;

	public string $url;

	public string $proxy_url;

	public int $height;

	public int $width;

	public function __construct($data)
	{
		$this->id = $data->id;
		$this->filename = $data->filename;
		$this->size = $data->size;
		$this->url = $data->url;
		$this->proxy_url = $data->proxy_url;
		$this->height = $data->height;
		$this->width = $data->width;
	}

}
