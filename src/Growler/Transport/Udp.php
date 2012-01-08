<?php

namespace Growler\Transport;

class Udp implements \Growler\Transport
{
    private $_connection;

    public function __construct($connection, $password = '')
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
        $data = '';
        $defaults = '';
        foreach ($notifications as $i => $notification)
        {
            $data     .= pack('n', strlen($notification->getName())) . $notification->getName();
            $defaults .= pack('c', $i);
        }

        // pack(Protocol version, type, app name, number of notifications to register)
        $data = pack('c2nc2', 1, 0, strlen($application->getName()), count($notifications),
                    count($notifications)) .
                $application->getName() . 
                $data . 
                $defaults;
        $this->_sendMessage($data);
    }

    /**
     * @param   string              $application    The application name
     * @param   Growler\Notification  $notification  The notification to send
     */
    public function send($application, $notification)
    {
        // pack(protocol version, type, priority/sticky flags, notification name length, title length, message length. app name length)
        $data = pack('c2n5', 1, 1, 0, strlen($notification->getType()->getName()), 
                    strlen($notification->getTitle()), strlen($notification->getMessage()), 
                    strlen($application->getName())) .
                $notification->getType()->getName() .
                $notification->getTitle() .
                $notification->getMessage() .
                $application->getName();
        $this->_sendMessage($data);
    }

    private function _sendMessage($message)
    {
        $message .= pack('H32', md5($message . $this->_password));
        $this->_connection->send($message);
    }
}