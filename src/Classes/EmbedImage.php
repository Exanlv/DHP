<?php

namespace DHP\Classes;

class EmbedImage
{
    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $proxy_url;

    /**
     * @var int
     */
    public $height;

    /**
     * @var int
     */
    public $width;

    public function __construct($data = null)
    {
        if ($data !== null) {
            if (property_exists($data, 'url'))
                $this->url = $data->url;

            if (property_exists($data, 'proxy_url'))
                $this->proxy_url = $data->proxy_url;

            if (property_exists($data, 'height'))
                $this->height = $data->height;
        
            if (property_exists($data, 'width'))
                $this->width = $data->width;
        }
    }
}