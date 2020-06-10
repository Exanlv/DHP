<?php

declare(strict_types = 1);

namespace DHP\Classes;

use DHP\RestClient\Client as RestClient;
use stdClass;

class Invite
{

	private RestClient $rest_client;

	public string $code;

	public ?Guild $guild;

	public Channel $channel;

	public ?User $inviter;

	public ?User $target_user;

	public ?int $target_user_type;

	public ?int $approximate_presence_count;

	public ?int $approximate_member_count;

	public function __construct(stdClass $data, RestClient &$rest_client)
	{
		$this->rest_client = &$rest_client;

		$this->code = $data->code;

		if (property_exists($data, 'guild'));
			$this->guild = new Guild($data->guild, $this->rest_client);

		$this->channel = new Channel($data->channel, $this->rest_client);

		if (property_exists($data, 'inviter'))
			$this->inviter = new User($data->inviter, $this->rest_client);

		if (property_exists($data, 'target_user'))
			$this->target_user = new User($data->target_user, $this->rest_client);

		if (property_exists($data, 'target_user_type'))
			$this->target_user_type = $data->target_user_type;

		if (property_exists($data, 'approximate_presence_count'))
			$this->approximate_presence_count = $data->approximate_presence_count;

		if (property_exists($data, 'approximate_member_count'))
			$this->approximate_member_count = $data->approximate_member_count;
	}

	public function invite_link(): string
	{
		return 'https://discord.gg/' . $this->code;
	}

}
