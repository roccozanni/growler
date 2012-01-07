<?php

namespace Growler\Gntp\Request;

class Register extends \Growler\Gntp\Request
{
    private $_notifications;

    public function __construct($application)
    {
        parent::__construct("REGISTER");
        $this->setHeader("Application-Name", $application);

        $this->_notifications = array();
        $this->setHeader('Notifications-Count', 0);
    }

    public function addNotificationType($type)
    {
        $this->_notifications[$type->getName()] = $type;
        $this->setHeader('Notifications-Count', count($this->_notifications));
    }

    protected function _getBody()
    {
        $result = "";
        foreach ($this->_notifications as $name => $type) 
        {
            $result .= "\r\n";
            $result .= "Notification-Name: " . $name . "\r\n";
            $result .= "Notification-Enabled: True\r\n";
        }

        return $result;
    }
}