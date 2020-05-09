<?php

namespace DHP\RestClient\Channel\Classes;

class SendMessageOptions
{
    /**
     * @var string
     */
    public $content;

    /**
     * @var integer|string
     */
    public $nonce;

    /**
     * @var boolean
     */
    public $tts;

    /**
     * @var any
     */
    public $file;

    /**
     * @var any
     */
    public $embed;

    /**
     * @var string
     */
    public $payload_json;

    /**
     * @var AllowedMentions
     */
    public $allowed_mentions;

    public function __construct()
    {
        $this->allowed_mentions = new AllowedMentions();
    }
}