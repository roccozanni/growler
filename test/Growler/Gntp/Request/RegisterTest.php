<?php

namespace Growler\Gntp\Request;

class RegisterTest extends \PHPUnit_Framework_TestCase
{
    public function testRegisterRequestWithNoNotifications()
    {
        $application = new \Growler\Application("Test application");
        $r = new \Growler\Gntp\Request\Register($application);

        $this->assertEquals(
            "GNTP/1.0 REGISTER NONE\r\n" .
            "X-Sender: Growler - PHP Growl notification library\r\n" .
            "Application-Name: " . $application->getName() ."\r\n" .
            "Notifications-Count: 0\r\n".
            "\r\n", 
            $r->__toString());
    }

    public function testRegisterRequestWithOneNotification()
    {
        $t1 = new \Growler\NotificationType("TYPE1");
        $application = new \Growler\Application("Test application");

        $r = new \Growler\Gntp\Request\Register($application);
        $r->addNotificationType($t1);

        $this->assertEquals(
            "GNTP/1.0 REGISTER NONE\r\n" .
            "X-Sender: Growler - PHP Growl notification library\r\n" .
            "Application-Name: " . $application->getName() ."\r\n" .
            "Notifications-Count: 1\r\n" .
            "\r\n" .
            "Notification-Name: TYPE1\r\n" .
            "Notification-Enabled: True\r\n" .
            "\r\n", 
            $r->__toString());
    }
    
    public function testRegisterRequestWithTwoNotifications()
    {
        $t1 = new \Growler\NotificationType("TYPE1");
        $t2 = new \Growler\NotificationType("TYPE2");
        $application = new \Growler\Application("Test application");

        $r = new \Growler\Gntp\Request\Register($application);
        $r->addNotificationType($t1);
        $r->addNotificationType($t2);

        $this->assertEquals(
            "GNTP/1.0 REGISTER NONE\r\n" .
            "X-Sender: Growler - PHP Growl notification library\r\n" .
            "Application-Name: " . $application->getName() ."\r\n" .
            "Notifications-Count: 2\r\n" .
            "\r\n" .
            "Notification-Name: TYPE1\r\n" .
            "Notification-Enabled: True\r\n" .
            "\r\n" .
            "Notification-Name: TYPE2\r\n" .
            "Notification-Enabled: True\r\n" .
            "\r\n", 
            $r->__toString());
    }

    public function testRegisterRequestWithApplicationIconUrl()
    {
        $t1 = new \Growler\NotificationType("TYPE1");
        $application = new \Growler\Application("Test application", "http://foo");

        $r = new \Growler\Gntp\Request\Register($application);
        $r->addNotificationType($t1);

        $this->assertEquals(
            "GNTP/1.0 REGISTER NONE\r\n" .
            "X-Sender: Growler - PHP Growl notification library\r\n" .
            "Application-Name: " . $application->getName() ."\r\n" .
            "Application-Icon: http://foo\r\n" .
            "Notifications-Count: 1\r\n" .
            "\r\n" .
            "Notification-Name: TYPE1\r\n" .
            "Notification-Enabled: True\r\n" .
            "\r\n", 
            $r->__toString());
    }
}