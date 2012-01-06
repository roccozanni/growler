<?php

namespace Growl;

class Notifier
{
    private $_application;
    private $_notifications;
    private $_transport;
    private $_registered;

    /**
     * Instance the notifier.
     *
     * @param   string              $application    The application name
     * @param   Growl\Transport     $transport      The transport used to send notifications
     */
    public function __construct($application, $transport)
    {
        $this->_application   = $application;
        $this->_notifications = array();
        $this->_transport     = $transport; 
        $this->_registered    = false;
    }

    /**
     * Register a new notification. All notifications needs to be registered before use.
     *
     * @param   Growl\NotificationType   $notification  The notification type to register
     */
    public function registerNotification(\Growl\NotificationType $notification)
    {
        $this->_notifications[] = $notification;
    }

    /**
     * Send a notification
     *
     * @param   Growl\Notification   $notification  The notification to register
     */
    public function sendNotification(\Growl\Notification $notification)
    {
        // Lazy registration
        if (!$this->_registered)
        {
            $this->_transport->register($this->_application, $this->_notifications);
            $this->_registered = true;
        }

        $this->_transport->send($this->_application, $notification);
    }

}
