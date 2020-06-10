<?php

declare(strict_types = 1);

namespace DHP\RestClient\Classes;

use Closure;

class QueuedRequest
{

	public string $method;

	public string $uri;

	public ?object $data;

	public ?object $headers;

	public ?Closure $callback;

	public string $expected_response_code;

}
