<?php

namespace Growler;

class NotifierTest extends \PHPUnit_Framework_TestCase
{
    public function testRegisterOnTransportIsNeverInvokedIfNoNotificationSent()
    {
        $application = new Application("Test application");
        $transport   = $this->getMock('\Growler\Transport');
        $transport->expects($this->never())
                  ->method('register');

        $n = new Notifier($application, $transport);
        $n->registerNotification(new NotificationType("TEST1"));
    }

    public function testRegisterOnTransportIsInvokedOneTimeWhenAtLeastOneNotificationIsSent()
    {
        $application = new Application("Test application");

        $type = new NotificationType("TEST1");
        $n1   = new Notification($type, "Title1", "Message1");
        $n2   = new Notification($type, "Title2", "Message2");

        $transport = $this->getMock('\Growler\Transport');
        $transport->expects($this->once())
                  ->method('register')
                  ->with($application, array($type));
                          
        $n = new Notifier($application, $transport);
        $n->registerNotification($type);
        $n->sendNotification($n1);
        $n->sendNotification($n2);
    }

    public function testUseTransportToSendMessage()
    {
        $application = new Application("Test application");

        $type = new NotificationType("TEST1");
        $n1   = new Notification($type, "Title1", "Message1");
        $n2   = new Notification($type, "Title2", "Message2");

        $transport = $this->getMock('\Growler\Transport');

        $transport->expects($this->exactly(2))
                  ->method('send');

        $transport->expects($this->at(1))
                  ->method('send')
                  ->with($application, $n1);

        $transport->expects($this->at(2))
                  ->method('send')
                  ->with($application, $n2);
                          
        $n = new Notifier($application, $transport);
        $n->registerNotification($type);
        $n->sendNotification($n1);
        $n->sendNotification($n2);
    }
}