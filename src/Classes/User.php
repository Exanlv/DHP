<?php

declare(strict_types = 1);

namespace DHP\Classes;

use DHP\RestClient\Client as RestClient;

class User
{

	private RestClient $rest_client;

	public string $id;

	public string $username;

	public string $discriminator;

	public string $avatar_hash;

	public bool $bot;

	public bool $system;

	/**
	 * @var bool ;
	 */
	public bool $two_factor_auth;

	/**
	 * @var bool ;
	 */
	public bool $verified_email;

	public string $locale;

	/**
	 * @var string;
	 */
	public string $email;

	public int $flags;

	public int $public_flags;

	public int $premium_type;

	/**
	 * @return void
	 */
	public function __construct($data, RestClient &$rest_client)
	{
		$this->rest_client = &$rest_client;

		$this->id = $data->id;
		$this->username = $data->username;
		$this->discriminator = $data->discriminator;
		$this->avatar = $data->avatar;

		if (property_exists($data, 'bot'))
			$this->bot = $data->bot;

		if (property_exists($data, 'system'))
			$this->system = $data->system;

		if (property_exists($data, 'mfa_enabled'))
			$this->two_factor_auth = $data->mfa_enabled;

		if (property_exists($data, 'locale'))
			$this->locale = $data->locale;

		if (property_exists($data, 'verified'))
			$this->verified_email = $data->verified;

		if (property_exists($data, 'email'))
			$this->email = $data->email;

		if (property_exists($data, 'flags'))
			$this->flags = $data->flags;

		if (property_exists($data, 'premium_type'))
			$this->premium_type = $data->premium_type;

		if (property_exists($data, 'public_flags'))
			$this->public_flags = $data->public_flags;
	}

}
