<?php

namespace Growler\Gntp\Request;

class Register extends \Growler\Gntp\Request
{
    private $_notifications;

    /**
     * @param Growl\Application     $application    The sender application
     */
    public function __construct($application, $password = null)
    {
        parent::__construct("REGISTER", $password);
        $this->setHeader("Application-Name", $application->getName());

        // Handle application icon
        if ($application->getIcon())
        {
            $resource = \Growler\Gntp\Resource::fromIdentifier($application->getIcon());
            if ($resource->isValid())
            {
                $this->setHeader("Application-Icon", $resource->getUniqueId());
                $this->_addResource($resource);
            }
        }

        $this->_notifications = array();
        $this->setHeader('Notifications-Count', 0);
    }

    /**
     * @param   \Growl\NotificationType     $type   The notification type to register
     */
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