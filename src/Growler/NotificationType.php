<?php

namespace Growler;

class NotificationType
{
    private $_name;
    
    public function __construct($name)
    {
        $this->_name = mb_convert_encoding($name, 'UTF-8', 'auto');
    }

    public function getName()
    {
        return $this->_name;
    }

}