<?php

namespace Growler;

class Notification
{
    private $_type;
    private $_title;
    private $_message;
    private $_icon;

    public function __construct($type, $title, $message, $icon = null)
    {
        $this->_type    = $type;
        $this->_title   = mb_convert_encoding($title, 'UTF-8', 'auto');
        $this->_message = mb_convert_encoding($message, 'UTF-8', 'auto');
        $this->_icon    = $icon;
    }

    public function getType()
    {
        return $this->_type;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    public function getIcon()
    {
        return $this->_icon;
    }

}