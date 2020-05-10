<?php

namespace DHP\RestClient\Channel\Classes;

class SendMessageOptions
{
    /**
     * @var string
     */
    public $content;

    /**
     * @var int|string
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
     * @var Embed
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

    /**
     * @todo
     * 
     * Payload
     * File
     */

    public function __construct()
    {
        $this->allowed_mentions = new AllowedMentions();
    }
}