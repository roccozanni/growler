<?php

namespace Growler;

class Application
{
    private $_name;
    private $_icon;

    public function __construct($name, $icon = null)
    {
        $this->_name = mb_convert_encoding($name, 'UTF-8', 'auto');
        $this->_icon = $icon;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getIcon()
    {
        return $this->_icon;
    }
}