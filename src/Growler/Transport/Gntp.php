<?php

namespace Growler\Transport;

class Gntp implements \Growler\Transport
{
    /**
     * @param   string  $application    The application name
     * @param   array   $notifications  The array of notifications to register
     */
    public function register($application, $notifications)
    {
        throw new Exception("Not implemented yet");
    }
    
    /**
     * @param   string              $application    The application name
     * @param   Growler\notification  $notification  The notification to send
     */
    public function send($application, $notification)
    {
        throw new Exception("Not implemented yet");
    }
}