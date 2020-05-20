<?php

namespace DHP\RestClient\Channel\Classes;

class FetchMessagesOptions
{
    /**
     * @var string
     */
    public $around;
    
    /**
     * @var string
     */
    public $before;

    /**
     * @var string
     */
    public $after;

    /**
     * @var int
     */
    public $limit;
}