<?php

namespace DHP\Classes;

class EmbedAuthor
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $icon_url;

    /**
     * @var int
     */
    public $proxy_icon_url;

    public function __construct($data = null)
    {
        if ($data !== null) {
            if (property_exists($data, 'name'))
                $this->name = $data->name;

            if (property_exists($data, 'url'))
                $this->url = $data->url;

            if (property_exists($data, 'icon_url'))
                $this->icon_url = $data->icon_url;

            if (property_exists($data, 'proxy_icon_url'))
                $this->proxy_icon_url = $data->proxy_icon_url;
        }
    }
}