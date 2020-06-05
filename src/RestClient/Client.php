<?php

declare(strict_types = 1);

namespace DHP\RestClient;

use Closure;
use DHP\RestClient\Channel\ChannelController;
use DHP\RestClient\Classes\QueuedRequest;
use stdClass;

class Client
{

	private string $token;

	private string $base_url = 'https://discord.com/api/';

	public object $last_requests;

	public object $request_queue;

	public ChannelController $channel_controller;

	public function __construct(string $token)
	{
		$this->last_requests = new stdClass();
		$this->request_queue = new stdClass();

		$this->token = $token;

		$this->channel_controller = new ChannelController($this);
	}

	/**
	 * Handles a tick
	 */
	public function tick(): void
	{
		foreach ($this->request_queue as $rate_limit_key => $request_group) {
			if (count($request_group) < 1) {
				unset($this->request_queue->{$rate_limit_key});
				continue;
			}

			if (!property_exists($this->last_requests, $rate_limit_key)) {
				$this->handle_queued_request($rate_limit_key);
				continue;
			}

			if (!property_exists($this->last_requests->{$rate_limit_key}->headers, 'x-ratelimit-bucket')) {
				$this->handle_queued_request($rate_limit_key);
				continue;
			}

			if ($this->last_requests->{$rate_limit_key}->headers->{'x-ratelimit-reset'} < time() || $this->last_requests->{$rate_limit_key}->headers->{'x-ratelimit-remaining'} > 0) {
				$this->handle_queued_request($rate_limit_key);
				continue;
			}
		}
	}


	/**
	 * Handle a queued request
	 * @param string $rate_limit_key
	 */
	private function handle_queued_request(string $rate_limit_key): void
	{
		$request = array_shift($this->request_queue->{$rate_limit_key});

		$res = $this->send_request($request->method, $request->uri, $request->data, $request->headers);

		$error = $res->status === $request->expected_response_code ?
			null : new Error($res->status, $res->data);

		if (property_exists($res->headers, 'x-ratelimit-bucket'))
			$this->last_requests->{$rate_limit_key} = $res;

		if ($request->callback !== null) {
			($request->callback)($error, $res);
		}
	}

	/**
	 * Remove requests of which the ratelimit reset timer has been reached
	 */
	public function cleanup(): void
	{
		foreach ($this->last_requests as $key => $request) {
			if (!property_exists($request->headers, 'x-ratelimit-reset') || $request->headers->{'x-ratelimit-reset'} < time()) {
				unset($this->last_requests->{$key});
			}
		}
	}

	public function queue_request(string $method, string $uri, ?object $data = null, ?object $headers = null, string $rate_limit_key, ?Closure $callback = null, string $expected_response_code = '200'): void
	{
		if (!property_exists($this->request_queue, $rate_limit_key))
			$this->request_queue->{$rate_limit_key} = [];

		$queued_request = new QueuedRequest();

		$queued_request->method = $method;
		$queued_request->uri = $uri;
		$queued_request->data = $data;
		$queued_request->headers = $headers;
		$queued_request->expected_response_code = $expected_response_code;
		$queued_request->callback = $callback;

		$this->request_queue->{$rate_limit_key}[] = $queued_request;
	}


	/**
	 * @param string $method
	 * @param string $uri
	 * @param [string => any] $data
	 * @param string[] $headers
	 *
	 * @return object
	 */
	private function send_request(string $method, string $uri, ?object $data = null, ?object $headers)
	{
		$req = curl_init($this->base_url . $uri);

		$setopt = [
			CURLOPT_CUSTOMREQUEST => strtoupper($method),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_HEADER => 1,
		];

		$default_headers = [
			'Content-Type: application/json',
			'Authorization: Bot ' . $this->token,
			'User-Agent: DiscordBot (https://github.com/Exanlv/DHP, pre-0.1)',
		];

		if ($data) {
			$encoded_data = json_encode($data);
			$setopt[CURLOPT_POSTFIELDS] = $encoded_data;
			$setopt[CURLOPT_HTTPHEADER] = array_merge(
				$default_headers,
				(array) $headers ?? [],
				[
					'Content-Length: ' . strlen($encoded_data),
				]
			);
		} else {
			$setopt[CURLOPT_HTTPHEADER] = array_merge(
				$default_headers,
				(array) $headers ?? [],
				[
					'Content-Length: 0',
				]
			);
		}

		curl_setopt_array($req, $setopt);

		return $this->format_response(curl_exec($req));
	}

	private function format_response(string $response): object
	{
		$data = explode("\n", $response);

		$formatted_data = [];

		$formatted_data['status'] = explode(' ', $data[0])[1];

		$i = count($data) - 1;

		$formatted_data['data'] = json_decode($data[$i]);

		unset($data[$i]);
		$i--;
		unset($data[$i]);
		unset($data[0]);

		$headers = [];

		foreach ($data as $header) {
			preg_match('/^(.*?):(.*)$/', $header, $matches);

			if (count($matches) === 3)
				$headers[trim($matches[1])] = trim($matches[2]);
		}

		$formatted_data['headers'] = (object) $headers;

		return (object) $formatted_data;
	}

}
