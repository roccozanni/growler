<?php

namespace Growler\Gntp\Request;

class RegisterTest extends \PHPUnit_Framework_TestCase
{
    public function testRegisterRequestWithNoNotificationsSerialization()
    {
        $application = "TEST";
        $r = new \Growler\Gntp\Request\Register($application);

        $this->assertEquals(
            "GNTP/1.0 REGISTER NONE\r\n" .
            "Application-Name: " . $application ."\r\n" .
            "Notifications-Count: 0\r\n".
            "\r\n", 
            $r->__toString());
    }

    public function testRegisterRequestWithOneNotificationSerialization()
    {
        $t1 = new \Growler\NotificationType("TYPE1");
        $application = "TEST";

        $r = new \Growler\Gntp\Request\Register($application);
        $r->addNotificationType($t1);

        $this->assertEquals(
            "GNTP/1.0 REGISTER NONE\r\n" .
            "Application-Name: " . $application ."\r\n" .
            "Notifications-Count: 1\r\n" .
            "\r\n" .
            "Notification-Name: TYPE1\r\n" .
            "Notification-Enabled: True\r\n" .
            "\r\n", 
            $r->__toString());
    }
    
    public function testRegisterRequestWithTwoNotificationsSerialization()
    {
        $t1 = new \Growler\NotificationType("TYPE1");
        $t2 = new \Growler\NotificationType("TYPE2");
        $application = "TEST";

        $r = new \Growler\Gntp\Request\Register($application);
        $r->addNotificationType($t1);
        $r->addNotificationType($t2);

        $this->assertEquals(
            "GNTP/1.0 REGISTER NONE\r\n" .
            "Application-Name: " . $application ."\r\n" .
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
}