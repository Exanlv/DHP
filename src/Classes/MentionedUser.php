<?php

declare(strict_types = 1);

namespace DHP\Classes;

use DHP\RestClient\Client as RestClient;
use stdClass;

class MentionedUser
{

	private RestClient $rest_client;

	/**
	 * @var \DHP\Classes\PartialMember ;
	 */
	public PartialMember $partial_member;

	public User $user;

	public function __construct(stdClass $data, RestClient &$rest_client)
	{
		$this->rest_client = &$rest_client;

		$this->user = new User($data, $this->rest_client);

		if (property_exists($data, 'member'))
			$this->partial_member = new PartialMember($data->member);
	}

}
