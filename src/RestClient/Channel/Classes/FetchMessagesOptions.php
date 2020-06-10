<?php

declare(strict_types = 1);

namespace DHP\RestClient\Channel\Classes;

class FetchMessagesOptions
{

	public string $around;

	public string $before;

	public string $after;

	public int $limit;

}
