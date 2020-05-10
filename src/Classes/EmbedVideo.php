<?php

namespace DHP\Classes;

class EmbedVideo
{
    /**
     * @var string
     */
    public $url;

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

            if (property_exists($data, 'width'))
                $this->width = $data->width;
        
            if (property_exists($data, 'height'))
                $this->height = $data->height;
        }
    }
}