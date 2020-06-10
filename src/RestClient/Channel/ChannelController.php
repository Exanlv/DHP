<?php

declare(strict_types = 1);

namespace DHP\RestClient\Channel;

use Closure;
use DHP\Classes\Channel;
use DHP\Classes\Emoji;
use DHP\Classes\Invite;
use DHP\Classes\Message;
use DHP\Classes\User;
use DHP\RestClient\Channel\Classes\CreateChannelInviteOptions;
use DHP\RestClient\Channel\Classes\EditChannelOptions;
use DHP\RestClient\Channel\Classes\EditMessageOptions;
use DHP\RestClient\Channel\Classes\FetchMessagesOptions;
use DHP\RestClient\Channel\Classes\GetReactionsOptions;
use DHP\RestClient\Channel\Classes\SendMessageOptions;
use DHP\RestClient\Client as RestClient;

class ChannelController
{

	private RestClient $rest_client;

	public function __construct(RestClient &$client)
	{
		$this->rest_client = &$client;
	}

	public function get(string $channel_id, ?Closure $callback = null): void
	{
		$uri = 'channels/' . $channel_id;

		$final_callback = $callback === null ? null : function ($error, $data) use ($callback): void {
			$channel = $error === null ? new Channel($data->data, $this->rest_client) : null;

			$callback($error, $channel);
		};

		$this->rest_client->queue_request('get', $uri, null, null, $uri, $final_callback);
	}

	public function edit(string $channel_id, EditChannelOptions $options, ?Closure $callback = null): void
	{
		$uri = 'channels/' . $channel_id;

		$final_callback = $callback === null ? null : function ($error, $data) use ($callback): void {
			$channel = $error === null ? new Channel($data->data, $this->rest_client) : null;

			$callback($error, $channel);
		};

		foreach ($options as $key => $option)
			if ($option === null)
				unset($options->{$key});

		$this->rest_client->queue_request('patch', $uri, $options, null, $uri, $final_callback);
	}

	public function delete(string $channel_id, ?Closure $callback = null): void
	{
		$uri = 'channels/' . $channel_id;

		$this->rest_client->queue_request('delete', $uri, null, null, $uri, $callback);
	}

	public function fetch_messages(string $channel_id, FetchMessagesOptions $options, ?Closure $callback = null): void
	{
		$uri = 'channels/' . $channel_id;

		$final_callback = $callback === null ? null : function ($error, $response) use ($callback): void {
			$messages = $error === null ? array_map(function ($msg) {
				return new Message($msg, $this->rest_client);
			}, $response->data) : null;

			$callback($error, $messages);
		};

		$this->rest_client->queue_request('get', $uri, $options, null, $uri, $final_callback);
	}

	public function fetch_message(string $channel_id, string $message_id, ?Closure $callback = null): void
	{
		$rate_limit_key = 'channels/' . $channel_id;
		$uri = $rate_limit_key . '/messages/' . $message_id;

		$final_callback = $callback === null ? null : function ($error, $response) use ($callback): void {
			$message = $error === null ? new Message($response->data, $this->rest_client) : null;

			$callback($error, $message);
		};

		$this->rest_client->queue_request('get', $uri, null, null, $uri, $final_callback);
	}

	public function send_message(string $channel_id, SendMessageOptions $options, ?Closure $callback = null): void
	{
		$uri = 'channels/' . $channel_id . '/messages';

		$final_callback = $callback === null ? null : function ($error, $response) use ($callback): void {
			$message = $error === null ? new Message($response->data, $this->rest_client) : null;

			$callback($error, $message);
		};

		$this->rest_client->queue_request('post', $uri, $options, null, $uri, $final_callback);
	}

	public function edit_message(string $channel_id, string $message_id, EditMessageOptions $options, ?Closure $callback = null): void
	{
		$rate_limit_key = 'channels/' . $channel_id . '/messages';
		$uri = $rate_limit_key . '/' . $message_id;

		$final_callback = $callback === null ? null : function ($error, $response) use ($callback): void {
			$message = $error === null ? new Message($response->data, $this->rest_client) : null;

			$callback($error, $message);
		};

		$this->rest_client->queue_request('patch', $uri, $options, null, $rate_limit_key, $final_callback);
	}

	public function delete_message(string $channel_id, string $message_id, ?Closure $callback = null): void
	{
		$rate_limit_key = 'channels/' . $channel_id . '/messages';
		$uri = $rate_limit_key . '/' . $message_id;

		$this->rest_client->queue_request('delete', $uri, null, null, $rate_limit_key, $callback, '204');
	}

	public function add_reaction(string $channel_id, string $message_id, Emoji $emoji, ?Closure $callback = null): void
	{
		$rate_limit_key = 'channels/' . $channel_id;
		$uri = $rate_limit_key . '/messages/' . $message_id . '/reactions/' . $emoji->url_identifier();

		$this->rest_client->queue_request('put', $uri, null, null, $rate_limit_key, $callback, '204');
	}

	public function delete_reaction(string $channel_id, string $message_id, Emoji $emoji, ?Closure $callback = null): void
	{
		$rate_limit_key = 'channels/' . $channel_id;
		$uri = $rate_limit_key . '/messages/' . $message_id . '/reactions/' . $emoji->url_identifier();

		$this->rest_client->queue_request('delete', $uri, null, null, $rate_limit_key, $callback, '204');
	}

	public function delete_user_reaction(string $channel_id, string $message_id, Emoji $emoji, string $user_id, ?Closure $callback = null): void
	{
		$rate_limit_key = 'channels/' . $channel_id;
		$uri = $rate_limit_key . '/messages/' . $message_id . '/reactions/' . $emoji->url_identifier() . '/' . $user_id;

		$this->rest_client->queue_request('delete', $uri, null, null, $rate_limit_key, $callback, '204');
	}

	public function get_reactions(string $channel_id, string $message_id, Emoji $emoji, GetReactionsOptions $options, ?Closure $callback = null): void
	{
		$rate_limit_key = 'channels/' . $channel_id;
		$uri = $rate_limit_key . '/messages/' . $message_id . '/reactions/' . $emoji->url_identifier();

		$final_callback = $callback === null ? null : function ($error, $response) use ($callback): void {
			$users = $error === null ? array_map(function ($obj) {
				return new User($obj, $this->rest_client);
			}, $response->data) : null;

			$callback($users);
		};

		$this->rest_client->queue_request('get', $uri, $options, null, $rate_limit_key, $final_callback);
	}

	public function delete_all_reactions(string $channel_id, string $message_id, ?Closure $callback = null): void
	{
		$rate_limit_key = 'channels/' . $channel_id;
		$uri = $rate_limit_key . '/messages/' . $message_id . '/reactions';

		$this->rest_client->queue_request('delete', $uri, null, null, $rate_limit_key, $callback);
	}

	public function delete_all_reactions_of_type(string $channel_id, string $message_id, Emoji $emoji, ?Closure $callback = null): void
	{
		$rate_limit_key = 'channels/' . $channel_id;
		$uri = $rate_limit_key . '/messages/' . $message_id . '/reactions/' . $emoji->url_identifier();

		$this->rest_client->queue_request('delete', $uri, null, null, $rate_limit_key, $callback);
	}

	/**
	 * @param string $channel_id
	 * @param string[] $message_ids
	 */
	public function bulk_delete_message(string $channel_id, array $message_ids): void
	{
	}

	public function edit_permissions(string $channel_id, string $overwrite_id): void
	{
	}

	public function get_invites(string $channel_id, ?Closure $callback = null): void
	{
		$uri = 'channels/' . $channel_id . '/invites';

		$final_callback = $callback === null ? : function ($error, $data) use ($callback): void {
			$invites = $error === null ? array_map(function ($invite) {
				return new Invite($invite, $this->rest_client);
			}, $data->data) : null;

			$callback($error, $invites);
		};

		$this->rest_client->queue_request('get', $uri, null, null, $uri, $final_callback);
	}

	public function create_invite(string $channel_id, CreateChannelInviteOptions $options, ?Closure $callback = null): void
	{
		$uri = 'channels/' . $channel_id . '/invites';

		foreach ($options as $key => $value)
			if ($value === null)
				unset($options->$key);

		$final_callback = $callback === null ? null : function ($error, $data) use ($callback): void {
			$invite = $error === null ? new Invite($data->data, $this->rest_client) : null;

			$callback($error, $invite);
		};

		$this->rest_client->queue_request('post', $uri, $options, null, $uri, $final_callback);
	}

	public function delete_permission(string $channel_id, string $overwrite_id): void
	{
	}

	public function trigger_typing_indicator(string $channel_id): void
	{
	}

	public function get_pinned_messages(string $channel_id, ?Closure $callback = null): void
	{
		$uri = 'channels/' . $channel_id . '/pins';

		$final_callback = $callback === null ? null : function ($error, $data) use ($callback): void {
			$pinned_messages = $error === null ? array_map(function ($d) {
				return new Message($d, $this->rest_client);
			}, $data->data) : null;

			$callback($error, $pinned_messages);
		};

		$this->rest_client->queue_request('get', $uri, null, null, $uri, $final_callback);
	}

	public function pin_message(string $channel_id, string $message_id, ?Closure $callback = null): void
	{
		$rate_limit_key = 'channels/' . $channel_id . '/pins';
		$uri = $rate_limit_key . '/' . $message_id;

		$this->rest_client->queue_request('put', $uri, null, null, $rate_limit_key, $callback, '204');
	}

	public function unpin_message(string $channel_id, string $message_id, ?Closure $callback = null): void
	{
		$rate_limit_key = 'channels/' . $channel_id . '/pins';
		$uri = $rate_limit_key . '/' . $message_id;

		$this->rest_client->queue_request('delete', $uri, null, null, $rate_limit_key, $callback, '204');
	}

}
