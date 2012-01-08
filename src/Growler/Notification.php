<?php

namespace Growler;

class Notification
{
    private $_type;
    private $_title;
    private $_message;
    private $_icon;

    /**
     * @param   Growler\NotificationType    $type   The notification type
     * @param   string                      $title  The title
     * @param   string                      $title  The message
     * @param   string                      $icon   The icon
     */
    public function __construct($type, $title, $message, $icon = null)
    {
        $this->_type    = $type;
        $this->_title   = mb_convert_encoding($title, 'UTF-8', 'auto');
        $this->_message = mb_convert_encoding($message, 'UTF-8', 'auto');
        $this->_icon    = $icon;
    }

    /**
     * Returns the type of this notification
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Returns the notification title
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Returns the notification message
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * Returns the notification icon
     */
    public function getIcon()
    {
        return $this->_icon;
    }

}