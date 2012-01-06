<?php

namespace Growl;

interface Transport
{
    /**
     * @param   string  $application    The application name
     * @param   array   $notifications  The array of notifications to register
     */
    public function register($application, $notifications);

    /**
     * @param   string              $application    The application name
     * @param   Growl\notification  $notification  The notification to send
     */
    public function send($application, $notification);
}