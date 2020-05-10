<?php
namespace DHP\RestClient;

use Closure;
use DHP\RestClient\Channel\ChannelController;
use DHPCore\Errors\DiscordAPIError;

class Client
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $base_url = 'https://discord.com/api/';

    /**
     * @var array
     */
    public $last_requests = [];

    /**
     * @var array
     */
    private $request_queue = [];

    /**
     * @var ChannelController
     */
    public $channel_controller;

    public function __construct($token)
    {
        $this->token = $token;

        $this->channel_controller = new ChannelController($this);
    }

    /**
     * Handles a tick
     */
    public function tick()
    {
        foreach ($this->request_queue as $rate_limit_key => $request_group) {
            if (count($request_group) < 1) {
                unset($this->request_queue[$rate_limit_key]);
                continue;
            }
            
            if (!isset($this->last_requests[$rate_limit_key])) {
                $this->handle_queued_request($rate_limit_key);
                continue;
            }

            if (!property_exists($this->last_requests[$rate_limit_key]->headers, 'x-ratelimit-bucket')) {
                $this->handle_queued_request($rate_limit_key);
                continue;
            }

            if ($this->last_requests[$rate_limit_key]->headers->{'x-ratelimit-reset'} < time() || $this->last_requests[$rate_limit_key]->headers->{'x-ratelimit-remaining'} > 0) {
                $this->handle_queued_request($rate_limit_key);
                continue;
            }
        }
    }


    /**
     * Handle a queued request
     */
    private function handle_queued_request($rate_limit_key)
    {
        $request = array_shift($this->request_queue[$rate_limit_key]);

        $res = $this->send_request($request->method, $request->uri, $request->data, $request->headers);

        if ($res->status !== $request->expected_response_code)
            throw new DiscordAPIError(print_r([$request, $res], true));
        
        if (property_exists($res->headers, 'x-ratelimit-bucket'))
            $this->last_requests[$rate_limit_key] = $res;

        if ($request->callback !== null) {
            ($request->callback)($res);
        }
    }

    /**
     * Remove requests of which the ratelimit reset timer has been reached
     */
    public function cleanup()
    {
        foreach ($this->last_requests as $key => $request) {
            if (!property_exists($request->headers, 'x-ratelimit-reset') ||$request->headers->{'x-ratelimit-reset'} < time()) {
                unset($this->last_requests[$key]);
            }
        }
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $data
     * @param array $headers
     * @param string $rate_limit_key
     * @param function $callback
     * 
     * @return object

     */
    public function queue_request($method, $uri, $data = null, $headers = [], $rate_limit_key, Closure $callback = null, $expected_response_code = '200')
    {
        if (!isset($this->request_queue[$rate_limit_key]))
            $this->request_queue[$rate_limit_key] = [];
        
        $this->request_queue[$rate_limit_key][] = (object) [
            'method' => $method,
            'uri' => $uri,
            'data' => $data,
            'headers' => $headers,
            'callback' => $callback,
            'expected_response_code' => $expected_response_code
        ];
    }


    /**
     * @param string $method
     * @param string $uri
     * @param array $data
     * @param array $headers
     * 
     * @return object
     */
    private function send_request($method, $uri, $data = null, $headers = [])
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
            'User-Agent: DiscordBot (https://github.com/Exanlv/DHP, pre-0.1)'
        ];

        if ($data) {
            $encoded_data = json_encode($data);
            $setopt[CURLOPT_POSTFIELDS] = $encoded_data;
            $setopt[CURLOPT_HTTPHEADER] = array_merge(
                $default_headers,
                $headers,
                [
                    'Content-Length: ' . strlen($encoded_data)
                ]
            );
        } else {
            $setopt[CURLOPT_HTTPHEADER] = array_merge(
                $default_headers,
                $headers,
                [
                    'Content-Length: 0'
                ]
            );
        }

        curl_setopt_array($req, $setopt);

        return $this->format_response(curl_exec($req));
    }

    /**
     * @param string $response
     * 
     * @return object
     */
    private function format_response($response)
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