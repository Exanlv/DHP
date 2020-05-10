<?php

namespace DHP\Classes;

class EmbedProvider
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $url;

    public function __construct($data = null)
    {
        if ($data !== null) {
            if (property_exists($data, 'name'))
                $this->name = $data->name;

            if (property_exists($data, 'url'))
                $this->url = $data->url;
        }
    }

}