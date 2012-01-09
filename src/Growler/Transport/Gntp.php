<?php

namespace Growler\Transport;

class Gntp implements \Growler\Transport
{
    private $_connection;
    private $_password;

    /**
     * @param   Growler\Connection  $connection     The remote connection
     */
    public function __construct($connection, $password = null)
    {
        $this->_connection = $connection;
        $this->_password   = $password;
    }
    
    /**
     * @param   string  $application    The application name
     * @param   array   $notifications  The array of notifications to register
     */
    public function register($application, $notifications)
    {
        $message = new \Growler\Gntp\Request\Register($application, $this->_password);
        foreach ($notifications as $notification) {
            $message->addNotificationType($notification);
        }

        $this->_connection->send($message->__toString());
        $this->_connection->consume();
        $this->_connection->disconnect();
    }
    
    /**
     * @param   string                $application    The application name
     * @param   Growler\notification  $notification  The notification to send
     */
    public function send($application, $notification)
    {
        $message = new \Growler\Gntp\Request\Notify($application, $notification, $this->_password);
        $this->_connection->send($message->__toString());
        $this->_connection->consume();
        $this->_connection->disconnect();
    }
}