<?php

declare(strict_types = 1);

namespace DHP\RestClient\Guild;

use Closure;
use DHP\RestClient\Client as RestClient;

class GuildController
{

	private RestClient $rest_client;

	public function __construct(RestClient &$client)
	{
		$this->rest_client = &$client;
	}

	public function get(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function get_preview(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function edit(string $guild_id, $options, ?Closure $callback = null): void
	{
	}

	public function delete(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function get_channels(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function create_channel(string $guild_id, $options, ?Closure $callback = null): void
	{
	}

	public function edit_channel_positions(string $guild_id, $options, ?Closure $callback = null): void
	{
	}

	public function get_guild_members(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function edit_guild_member(string $guild_id, string $user_id, $options, ?Closure $callback = null): void
	{
	}

	public function edit_nickname(string $guild_id, $options, ?Closure $callback = null): void
	{
	}

	public function add_guild_member_role(string $guild_id, string $user_id, string $role_id, ?Closure $callback = null): void
	{
	}

	public function remove_guild_member_role(string $guild_id, string $user_id, string $role_id, ?Closure $callback = null): void
	{
	}

	public function add_guild_member(string $guild_id, string $user_id, $options, ?Closure $callback = null): void
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

	public function create_guild_ban(string $guild_id, string $user_id, $options, ?Closure $callback = null): void
	{
	}

	public function remove_guild_ban(string $guild_id, string $user_id, ?Closure $callback = null): void
	{
	}

	public function get_guild_roles(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function create_guild_role(string $guild_id, $options, ?Closure $callback = null): void
	{
	}

	public function edit_guild_role(string $guild_id, string $role_id, $options, ?Closure $callback = null): void
	{
	}

	public function edit_guild_role_positions(string $guild_id, $options, ?Closure $callback = null): void
	{
	}

	public function delete_guild_role(string $guild_id, string $role_id, ?Closure $callback = null): void
	{
	}

	public function get_guild_prune_count(string $guild_id, $options, ?Closure $callback = null): void
	{
	}

	public function start_guild_prune(string $guild_id, $options, ?Closure $callback = null): void
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

	public function create_guild_integration(string $guild_id, $options, ?Closure $callback = null): void
	{
	}

	public function edit_guild_integration(string $guild_id, string $integration_id, $options, ?Closure $callback = null): void
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

	public function get_guild_widget_image(string $guild_id, $options, ?Closure $callback = null): void
	{
	}

	public function edit_guild_widget(string $guild_id, $options, ?Closure $callback = null): void
	{
	}

	public function get_guild_embed(string $guild_id, ?Closure $callback = null): void
	{
	}

	public function edit_guild_embed(string $guild_id, $options, ?Closure $callback = null): void
	{
	}

	public function get_guild_vanity_url(string $guild_id, $options, ?Closure $callback = null): void
	{
	}

}
