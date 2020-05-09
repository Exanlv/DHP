<?php

namespace DHP\RestClient\Channel\Classes;

class AllowedMentions
{
    /**
     * @var string[]
     */
    public $parse = ['users', 'roles', 'everyone'];

    /**
     * @var string[]
     */
    public $users;
}