<?php

declare(strict_types = 1);

namespace DHP\RestClient\Channel\Classes;

use DHP\Classes\Embed;

class SendMessageOptions
{

	public string $content;

	/**
	 * @var int|string
	 */
	public $nonce;

	public bool $tts;

	public any $file;

	public Embed $embed;

	public string $payload_json;

	public AllowedMentions $allowed_mentions;

	public function __construct()
	{
		$this->allowed_mentions = new AllowedMentions();
	}

}

/**
 * @todo
 *
 * Payload
 * File
 */
