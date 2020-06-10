<?php

declare(strict_types = 1);

namespace DHP\Classes;

use Closure;
use DHP\RestClient\Channel\Classes\EditMessageOptions;
use DHP\RestClient\Channel\Classes\SendMessageOptions;
use DHP\RestClient\Client as RestClient;
use DateTime;
use DateTimeZone;
use stdClass;

class Message
{

	public string $id;

	public string $channel_id;

	public string $guild_id;

	public User $user;

	public PartialMember $partial_member;

	public string $content;

	public DateTime $sent_at;

	public DateTime $edited_at;

	public bool $tts;

	public bool $mentioned_everyone;

	/**
	 * @var \DHP\Classes\MentionedUser[]
	 */
	public array $mentioned_users;

	/**
	 * @var string[]
	 */
	public array $mentioned_roles;

	/**
	 * @var string[]
	 */
	public array $mentioned_channels;

	/**
	 * @var \DHP\Classes\Attachment[]
	 */
	public array $attachments = [];

	/**
	 * @var \DHP\Classes\Embed[]
	 */
	public array $embeds = [];

	/**
	 * @var int|string
	 */
	public $nonce;

	public bool $pinned;

	public string $webhook_id;

	public string $type;

	private RestClient $rest_client;

	public function __construct(stdClass $data, RestClient &$rest_client)
	{
		$this->rest_client = &$rest_client;

		$utc_date_time_zone = new DateTimeZone('UTC');

		$this->id = $data->id;
		$this->channel_id = $data->channel_id;

		if (property_exists($data, 'guild_id'))
			$this->guild_id = $data->guild_id;

		$this->user = new User($data->author, $this->rest_client);

		if (property_exists($data, 'member'))
			$this->partial_member = new PartialMember($data->member);

		$this->content = $data->content;
		$this->sent_at = new DateTime($data->timestamp, $utc_date_time_zone);

		if (property_exists($data, 'edited_at'))
			$this->edited_at = new DateTime($data->edited_timestamp, $utc_date_time_zone);

		$this->tts = $data->tts;
		$this->mentioned_everyone = $data->mention_everyone;
		$this->mentioned_users = [];

		foreach ($data->mentions as $mentioned_user_data)
			$this->mentioned_users[] = new MentionedUser($mentioned_user_data, $this->rest_client);

		$this->mentioned_roles = $data->mention_roles;

		if (property_exists($data, 'mention_channels'))
			$this->mentioned_channels = $data->mention_channels;

		$this->attachments = [];

		foreach ($data->attachments as $attachment_data)
			$this->attachments[] = $attachment_data;

		foreach ($data->embeds as $embed)
			$this->embeds[] = new Embed($embed);

		if (property_exists($data, 'nonce'))
			$this->nonce = $data->nonce;

		$this->pinned = $data->pinned;

		if (property_exists($data, 'webhook_id'))
			$this->webhook_id = $data->webhook_id;

		$this->type = [
			'DEFAULT',
			'RECIPIENT_ADD',
			'RECIPIENT_REMOVE',
			'CALL',
			'CHANNEL_NAME_CHANGE',
			'CHANNEL_ICON_CHANGE',
			'CHANNEL_PINNED_MESSAGE',
			'GUILD_MEMBER_JOIN',
			'USER_PREMIUM_GUILD_SUBSCRIPTION',
			'USER_PREMIUM_GUILD_SUBSCRIPTION_TIER_1',
			'USER_PREMIUM_GUILD_SUBSCRIPTION_TIER_2',
			'USER_PREMIUM_GUILD_SUBSCRIPTION_TIER_3',
			'CHANNEL_FOLLOW_ADD',
			'GUILD_DISCOVERY_DISQUALIFIED',
			'GUILD_DISCOVERY_REQUALIFIED',
		][$data->type];
	}

	public function reply(SendMessageOptions $options, ?Closure $callback = null): void
	{
		$this->rest_client->channel_controller->send_message(
			$this->channel_id,
			$options,
			$callback
		);
	}

	public function edit(EditMessageOptions $options, ?Closure $callback = null): void
	{
		$this->rest_client->channel_controller->edit_message(
			$this->channel_id,
			$this->id,
			$options,
			$callback
		);
	}

	public function channel(Closure $callback): void
	{
		$this->rest_client->channel_controller->get($this->channel_id, $callback);
	}

	public function delete(?Closure $callback = null): void
	{
		$this->rest_client->channel_controller->delete_message($this->channel_id, $this->id, $callback);
	}

	public function pin(?Closure $callback = null): void
	{
		$this->rest_client->channel_controller->pin_message($this->channel_id, $this->id, $callback);
	}

	public function unpin(?Closure $callback = null): void
	{
		$this->rest_client->channel_controller->unpin_message($this->channel_id, $this->id, $callback);
	}

}

/**
 * @todo
 *  - embeds
 *  - reactions?
 *  - activity?
 *  - application?
 *  - message_reference?
 *  - flags?
 *  - webhook user
 *  - type enum
 */
