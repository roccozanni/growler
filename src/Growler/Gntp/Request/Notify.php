<?php

namespace Growler\Gntp\Request;

class Notify extends \Growler\Gntp\Request
{
    public function __construct($application, $notification)
    {
        parent::__construct("NOTIFY");

        $this->setHeader("Application-Name",  $application);
        $this->setHeader("Notification-Name", $notification->getType()->getName());
        $this->setHeader("Notification-Title", $notification->getTitle());
        $this->setHeader("Notification-Text", $notification->getMessage());
    }
}