<?php

namespace DHP\Classes;

class EmbedField
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $value;

    /**
     * @var boolean
     */
    public $inline;

    public function __construct($data = null)
    {
        if ($data !== null) {
            if (property_exists($data, 'name'))
                $this->name = $data->name;

            if (property_exists($data, 'value'))
                $this->value = $data->value;

            if (property_exists($data, 'inline'))
                $this->inline = $data->inline;
        }
    }
}