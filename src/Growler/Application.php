<?php

namespace Growler;

class Application
{
    private $_name;
    private $_icon;

    /**
     * @param   string  $name   The name
     * @param   string  $icon   The icon
     */
    public function __construct($name, $icon = null)
    {
        $this->_name = mb_convert_encoding($name, 'UTF-8', 'auto');
        $this->_icon = $icon;
    }

    /**
     * Returns the application name
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Returns the application icon
     */
    public function getIcon()
    {
        return $this->_icon;
    }
}