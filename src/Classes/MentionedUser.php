<?php
namespace DHP\Classes;

use DHP\Classes\PartialMember;
use DHP\Classes\User;

class MentionedUser
{
    /**
     * @var PartialMember;
     */
    public $partial_member;

    /**
     * @var User
     */
    public $user;

    public function __construct($data)
    {
        $this->user = new User($data);

        if (property_exists($data, 'member'))
            $this->partial_member = new PartialMember($data->member);
    }
}