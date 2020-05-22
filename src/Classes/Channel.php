<?php

declare(strict_types = 1);

namespace DHP\Classes;

use Closure;
use DHP\RestClient\Channel\Classes\CreateChannelInviteOptions;
use DHP\RestClient\Channel\Classes\EditChannelOptions;
use DHP\RestClient\Client as RestClient;
use stdClass;

class Channel
{

	private RestClient $rest_client;

	public string $id;

	public string $type;

	public string $guild_id;

	public string $position;

	/**
	 * @var \DHP\Classes\PermissionOverwrite[]
	 */
	public array $permission_overwrites = [];

	public string $name;

	public string $topic;

	public bool $nsfw;

	public string $last_message_id;

	public int $bitrate;

	public int $user_limit;

	public int $user_rate_limit;

	/**
	 * @var \DHP\Classes\User[]
	 */
	public array $recipients = [];

	public string $icon;

	public string $owner_id;

	public string $application_id;

	public string $parent_id;

	public string $last_pin_timestamp;

	public function __construct(stdClass $data, RestClient &$rest_client)
	{
		$this->rest_client = &$rest_client;

		$this->id = $data->id;

		$this->type = [
			'GUILD_TEXT',
			'DM',
			'GUILD_VOICE',
			'GROUP_DM',
			'GUILD_CATEGORY',
			'GUILD_NEWS',
			'GUILD_STORE',
		][$data->type];

		if (property_exists($data, 'guild_id'))
			$this->guild_id = $data->guild_id;

		if (property_exists($data, 'position'))
			$this->position = $data->position;

		if (property_exists($data, 'permission_overwrites'))
			foreach ($data->permission_overwrites as $permission_overwrite)
				$this->permission_overwrites[] = new PermissionOverwrite($permission_overwrite);

		if (property_exists($data, 'name'))
			$this->name = $data->name;

		if (property_exists($data, 'topic'))
			$this->topic = $data->topic;

		if (property_exists($data, 'nsfw'))
			$this->nsfw = $data->nsfw;

		if (property_exists($data, 'last_message_id'))
			$this->last_message_id = $data->last_message_id;

		if (property_exists($data, 'bitrate'))
			$this->bitrate = $data->bitrate;

		if (property_exists($data, 'user_limit'))
			$this->user_limit = $data->user_limit;

		if (property_exists($data, 'rate_limit_per_user'))
			$this->rate_limit_per_user = $data->rate_limit_per_user;

		if (property_exists($data, 'recipients'))
			foreach ($data->recipients as $user)
				$this->recipients[] = new User($user, $this->rest_client);

		if (property_exists($data, 'icon'))
			$this->icon = $data->icon;

		if (property_exists($data, 'owner_id'))
			$this->owner_id = $data->owner_id;

		if (property_exists($data, 'application_id'))
			$this->application_id = $data->application_id;

		if (property_exists($data, 'parent_id'))
			$this->parent_id = $data->parent_id;

		if (property_exists($data, 'last_pin_timestamp'))
			$this->last_pin_timestamp = $data->last_pin_timestamp;
	}

	public function edit(EditChannelOptions $options, ?Closure $callback = null): void
	{
		$this->rest_client->channel_controller->edit($this->id, $options, $callback);
	}

	public function delete(?Closure $callback = null): void
	{
		$this->rest_client->channel_controller->delete($this->id, $callback);
	}

	public function get_pinned_messages(Closure $callback): void
	{
		$this->rest_client->channel_controller->get_pinned_messages($this->id, $callback);
	}

	public function create_invite(CreateChannelInviteOptions $options, ?Closure $callback = null): void
	{
		$this->rest_client->channel_controller->create_invite($this->id, $options, $callback);
	}

	public function get_invites(Closure $callback): void
	{
		$this->rest_client->channel_controller->get_invites($this->id, $callback);
	}

}
