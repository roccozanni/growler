<?php

namespace Growler\Gntp\Request;

class NotifyTest extends \PHPUnit_Framework_TestCase
{
    public function testNotifyRequestWithNoIcon()
    {
        $application = new \Growler\Application("Test application");

        $n = new \Growler\Notification(
            new \Growler\NotificationType("TYPE1"),
            "Title", "Message"
        );

        $r = new \Growler\Gntp\Request\Notify($application ,$n);

        $this->assertEquals(
            "GNTP/1.0 NOTIFY NONE\r\n" .
            "X-Sender: Growler - PHP Growl notification library\r\n" .
            "Application-Name: " .   $application->getName() ."\r\n" .
            "Notification-Name: " .  $n->getType()->getName() ."\r\n" .
            "Notification-Title: " . $n->getTitle() ."\r\n" .
            "Notification-Text: " .  $n->getMessage() ."\r\n" .
            "\r\n", 
            $r->__toString());
    }

    public function testNotifyRequestWithNotificationTypeCustomIcon()
    {
        $application = new \Growler\Application("Test application");

        $n = new \Growler\Notification(
            new \Growler\NotificationType("TYPE1", "http://foo"),
            "Title", "Message"
        );

        $r = new \Growler\Gntp\Request\Notify($application ,$n);

        $this->assertEquals(
            "GNTP/1.0 NOTIFY NONE\r\n" .
            "X-Sender: Growler - PHP Growl notification library\r\n" .
            "Application-Name: " .   $application->getName() ."\r\n" .
            "Notification-Name: " .  $n->getType()->getName() ."\r\n" .
            "Notification-Title: " . $n->getTitle() ."\r\n" .
            "Notification-Text: " .  $n->getMessage() ."\r\n" .
            "Notification-Icon: " .  $n->getType()->getIcon() ."\r\n" .
            "\r\n", 
            $r->__toString());
    }

    public function testNotifyRequestWithNotificationCustomIcon()
    {
        $application = new \Growler\Application("Test application");

        $n = new \Growler\Notification(
            new \Growler\NotificationType("TYPE1"),
            "Title", "Message",
            "http://foo"
        );

        $r = new \Growler\Gntp\Request\Notify($application ,$n);

        $this->assertEquals(
            "GNTP/1.0 NOTIFY NONE\r\n" .
            "X-Sender: Growler - PHP Growl notification library\r\n" .
            "Application-Name: " .   $application->getName() ."\r\n" .
            "Notification-Name: " .  $n->getType()->getName() ."\r\n" .
            "Notification-Title: " . $n->getTitle() ."\r\n" .
            "Notification-Text: " .  $n->getMessage() ."\r\n" .
            "Notification-Icon: " .  $n->getIcon() ."\r\n" .
            "\r\n", 
            $r->__toString());
    }

}