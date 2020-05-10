<?php
namespace DHP\Classes;

class Attachment
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $filename;

    /**
     * @var int
     */
    public $size;

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

    public function __construct($data)
    {
        $this->id = $data->id;
        $this->filename = $data->filename;
        $this->size = $data->size;
        $this->url = $data->url;
        $this->proxy_url = $data->proxy_url;
        $this->height = $data->height;
        $this->width = $data->width;
    }
}