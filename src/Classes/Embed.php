<?php

declare(strict_types = 1);

namespace DHP\Classes;

use stdClass;

class Embed
{

	public string $title;

	public string $type = 'rich';

	public string $description;

	public string $url;

	public string $timestamp;

	public int $color;

	public EmbedFooter $footer;

	public EmbedImage $image;

	public EmbedThumbnail $thumbnail;

	public EmbedVideo $video;

	public EmbedProvider $provider;

	public EmbedAuthor $author;

	/**
	 * @var \DHP\Classes\EmbedField[]
	 */
	public array $fields = [];

	public function __construct(?stdClass $data = null)
	{
		if ($data === null) {
			$this->footer = new EmbedFooter();
			$this->image = new EmbedImage();
			$this->thumbnail = new EmbedThumbnail();
			$this->video = new EmbedVideo();
			$this->provider = new EmbedProvider();
			$this->author = new EmbedAuthor();
		} else {
			if (property_exists($data, 'title'))
				$this->title = $data->title;

			if (property_exists($data, 'type'))
				$this->type = $data->type;

			if (property_exists($data, 'description'))
				$this->description = $data->description;

			if (property_exists($data, 'url'))
				$this->url = $data->url;

			if (property_exists($data, 'timestamp'))
				$this->timestamp = $data->timestamp;

			if (property_exists($data, 'color'))
				$this->color = $data->color;

			$this->footer = new EmbedFooter(property_exists($data, 'footer') ? $data->footer : null);
			$this->image = new EmbedImage(property_exists($data, 'image') ? $data->image : null);
			$this->thumbnail = new EmbedThumbnail(property_exists($data, 'thumbnail') ? $data->thumbnail : null);
			$this->video = new EmbedVideo(property_exists($data, 'video') ? $data->video : null);
			$this->provider = new EmbedProvider(property_exists($data, 'provider') ? $data->provider : null);
			$this->author = new EmbedAuthor(property_exists($data, 'author') ? $data->author : null);

			if (property_exists($data, 'fields'))
				foreach ($data->fields as $field)
					$this->fields[] = new EmbedField($field);
		}
	}

	public function set_color_hex(string $hex): void
	{
		$this->color = hexdec($hex);
	}

}
