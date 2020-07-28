<?php

declare(strict_types = 1);

namespace DHP\RestClient\Guild;

use Closure;
use DHP\Classes\Guild;
use DHP\RestClient\Client as RestClient;
use DHP\RestClient\Guild\Classes\AddGuildMemberOptions;
use DHP\RestClient\Guild\Classes\CreateChannelOptions;
use DHP\RestClient\Guild\Classes\CreateGuildBanOptions;
use DHP\RestClient\Guild\Classes\CreateGuildIntegrationsOptions;
use DHP\RestClient\Guild\Classes\CreateGuildOptions;
use DHP\RestClient\Guild\Classes\CreateGuildRoleOptions;
use DHP\RestClient\Guild\Classes\EditChannelPositionsOptions;
use DHP\RestClient\Guild\Classes\EditGuildIntegrationsOptions;
use DHP\RestClient\Guild\Classes\EditGuildMemberOptions;
use DHP\RestClient\Guild\Classes\EditGuildOptions;
use DHP\RestClient\Guild\Classes\EditGuildRoleOptions;
use DHP\RestClient\Guild\Classes\EditGuildRolePositionsOptions;
use DHP\RestClient\Guild\Classes\EditGuildWidgetOptions;
use DHP\RestClient\Guild\Classes\EditNicknameOptions;
use DHP\RestClient\Guild\Classes\GetGuildPruneCountOptions;
use DHP\RestClient\Guild\Classes\GetGuildWidgetOptions;
use DHP\RestClient\Guild\Classes\StartGuildPruneOptions;

class GuildController
{

	private RestClient $rest_client;

	public function __construct(RestClient &$client)
	{
		$this->rest_client = &$client;
	}

	public function create(CreateGuildOptions $options, ?Closure $callback): void
	{
		$uri = 'guilds';

		$final_callback = $callback === null ? null : function ($error, $data) use ($callback): void {
			$guild = $error === null ? new Guild($data, $this->rest_client) : null;

			$callback($error, $guild);
		};

		$this->rest_client->queue_request('post', $uri, $options, null, $uri, $final_callback);
	}

	public function get(string $guild_id, ?Closure $callback = null): void
	{
		$rate_limit_key = 'guilds/' . $guild_id;
		$uri = $rate_limit_key . '?with_counts=true';

		$final_callback = $callback === null ? null : function ($error, $data) use ($callback): void {
			$guild = $error === null ? new Guild($data, $this->rest_client) : null;

			$callback($error, $guild);
		};

		$this->rest_client->queue_request('get', $uri, null, null, $rate_limit_key, $final_callback);
	}

	public function get_preview(string $guild_id, ?Closure $callback = null): void
	{
		$rate_limit_key = 'guilds/' . $guild_id;
		$uri = $rate_limit_key . '/preview';
	}

	public function edit(string $guild_id, EditGuildOptions $options, ?Closure $callback = null): void
	{
	}

	public function delete(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function get_channels(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function create_channel(string $guild_id, CreateChannelOptions $options, ?Closure $callback = null): void
	{
	}

	public function edit_channel_positions(string $guild_id, EditChannelPositionsOptions $options, ?Closure $callback = null): void
	{
	}

	public function get_guild_members(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function edit_guild_member(string $guild_id, string $user_id, EditGuildMemberOptions $options, ?Closure $callback = null): void
	{
	}

	public function edit_nickname(string $guild_id, EditNicknameOptions $options, ?Closure $callback = null): void
	{
	}

	public function add_guild_member_role(string $guild_id, string $user_id, string $role_id, ?Closure $callback = null): void
	{
	}

	public function remove_guild_member_role(string $guild_id, string $user_id, string $role_id, ?Closure $callback = null): void
	{
	}

	public function add_guild_member(string $guild_id, string $user_id, AddGuildMemberOptions $options, ?Closure $callback = null): void
	{
	}

	public function remove_guild_member(string $guild_id, string $user_id, ?Closure $callback = null): void
	{
	}

	public function get_guild_bans(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function get_guild_ban(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function create_guild_ban(string $guild_id, string $user_id, CreateGuildBanOptions $options, ?Closure $callback = null): void
	{
	}

	public function remove_guild_ban(string $guild_id, string $user_id, ?Closure $callback = null): void
	{
	}

	public function get_guild_roles(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function create_guild_role(string $guild_id, CreateGuildRoleOptions $options, ?Closure $callback = null): void
	{
	}

	public function edit_guild_role(string $guild_id, string $role_id, EditGuildRoleOptions $options, ?Closure $callback = null): void
	{
	}

	public function edit_guild_role_positions(string $guild_id, EditGuildRolePositionsOptions $options, ?Closure $callback = null): void
	{
	}

	public function delete_guild_role(string $guild_id, string $role_id, ?Closure $callback = null): void
	{
	}

	public function get_guild_prune_count(string $guild_id, GetGuildPruneCountOptions $options, ?Closure $callback = null): void
	{
	}

	public function start_guild_prune(string $guild_id, StartGuildPruneOptions $options, ?Closure $callback = null): void
	{
	}

	public function get_guild_voice_regions(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function get_guild_invites(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function get_guild_integrations(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function create_guild_integration(string $guild_id, CreateGuildIntegrationsOptions $options, ?Closure $callback = null): void
	{
	}

	public function edit_guild_integration(string $guild_id, string $integration_id, EditGuildIntegrationsOptions $options, ?Closure $callback = null): void
	{
	}

	public function delete_guild_integration(string $guild_id, string $integration_id, ?Closure $callback = null): void
	{
	}

	public function sync_guild_integration(string $guild_id, string $integration_id, ?Closure $callback = null): void
	{
	}

	public function get_guild_widget(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function get_guild_widget_image(string $guild_id, GetGuildWidgetOptions $options, ?Closure $callback = null): void
	{
	}

	public function edit_guild_widget(string $guild_id, EditGuildWidgetOptions $options, ?Closure $callback = null): void
	{
	}

	public function get_guild_vanity_url(string $guild_id, ?Closure $callback = null): void
	{
	}

}
