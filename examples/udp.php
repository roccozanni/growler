<?php

// If you already have a PSR-0 compliant autoloader, this is not needed.
// Simply register the Growl namespace to the "src" directory
require_once __DIR__.'/../src/Growl/ClassLoader.php';
Growl\ClassLoader::register();

// Create components
$connection = new Growl\Connection("udp", "localhost", 9887);
$transport  = new Growl\Transport\Udp($connection);
$notifier   = new Growl\Notifier("Test application", $transport);

// Register notification types
$type1      = new Growl\NotificationType("TYPE1");
$notifier->registerNotification($type1);

// Send notification
$notifier->sendNotification(new Growl\Notification($type1, "Notification title", "Notification message"));
$notifier->sendNotification(new Growl\Notification($type1, "Notification title2", "Notification message2"));