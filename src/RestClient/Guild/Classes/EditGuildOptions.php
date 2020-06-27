<?php

declare(strict_types = 1);

namespace DHP\RestClient\Guild\Classes;

class EditGuildOptions
{

	public ?string $name;

	public ?string $region;

	public ?int $verification_level;

	public ?int $default_message_notifications;

	public ?int $explicit_content_filter;

	public ?string $afk_channel_id;

	public ?int $afk_timeout;

	public ?string $icon;

	public ?string $owner_id;

	public ?string $splash;

	public ?string $banner;

	public ?string $system_channel_id;

	public ?string $rules_channel_id;

	public ?string $public_updates_channel_id;

	public ?string $preferred_locale;

}
