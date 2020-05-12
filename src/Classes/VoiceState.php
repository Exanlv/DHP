<?php

namespace DHP\Classes;

class VoiceState
{
    /**
     * @var string
     */
    public $guild_id;

    /**
     * @var string
     */
    public $channel_id;

    /**
     * @var string
     */
    public $user_id;

    /**
     * @var string
     */
    public $session_id;

    /**
     * @var string
     */
    public $deaf;

    /**
     * @var string
     */
    public $mute;

    /**
     * @var string
     */
    public $self_deaf;

    /**
     * @var string
     */
    public $self_mute;

    /**
     * @var string
     */
    public $self_stream;

    /**
     * @var string
     */
    public $suppress;

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