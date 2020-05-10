<?php

namespace DHP\Classes;

class EmbedFooter
{
    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $icon_url;

    /**
     * @var string
     */
    public $proxy_icon_url;

    public function __construct($data = null)
    {
        if ($data !== null) {
            if (property_exists($data, 'text'))
                $this->text = $data->text;

            if (property_exists($data, 'icon_url'))
                $this->icon_url = $data->icon_url;

            if (property_exists($data, 'proxy_icon_url'))
                $this->proxy_icon_url = $data->proxy_icon_url;
        }
    }
}