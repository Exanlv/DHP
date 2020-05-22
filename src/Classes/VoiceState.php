<?php

declare(strict_types = 1);

namespace DHP\Classes;

class VoiceState
{

	public string $guild_id;

	public string $channel_id;

	public string $user_id;

	public string $session_id;

	public string $deaf;

	public string $mute;

	public string $self_deaf;

	public string $self_mute;

	public string $self_stream;

	public string $suppress;

	public function __construct($data)
	{
		if (property_exists($data, 'guild_id'))
			$this->guild_id = $data->guild_id;

		$this->channel_id = $data->channel_id;

		$this->user_id = $data->user_id;

		if (property_exists($data, 'member'))
			$this->member = $data->member;

		$this->session_id = $data->session_id;

		$this->deaf = $data->deaf;

		$this->mute = $data->mute;

		$this->self_deaf = $data->self_deaf;

		$this->self_mute = $data->self_mute;

		if (property_exists($data, 'self_stream'))
			$this->self_stream = $data->self_stream;

		$this->suppress = $data->suppress;
	}

}
