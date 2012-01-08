<?php

namespace Growler\Gntp\Request;

class Notify extends \Growler\Gntp\Request
{
    /**
     * @param Growl\Application     $application    The sender application
     * @param Growl\Notification    $notification   The notification instance
     */
    public function __construct($application, $notification)
    {
        parent::__construct("NOTIFY");

        $this->setHeader("Application-Name",   $application->getName());
        $this->setHeader("Notification-Name",  $notification->getType()->getName());
        $this->setHeader("Notification-Title", $notification->getTitle());
        $this->setHeader("Notification-Text",  $notification->getMessage());

        // GNTP protocol have icon support for notifications type, 
        //      so you can just send the icon resource at REGISTER time.
        // Growl 1.3 does not support this feature yet, so you need to send icon binary 
        //      every time you want to notify the message

        $resource = null;
        if ($notification->getIcon()) {
            $resource = \Growler\Gntp\Resource::build($notification->getIcon());
        } else if ($notification->getType()->getIcon()) {
            $resource = \Growler\Gntp\Resource::build($notification->getType()->getIcon());
        }

        if ($resource && $resource->isValid())
        {
            $this->setHeader("Notification-Icon", $resource->getUniqueId());
            $this->_addResource($resource);
        }
    }
}