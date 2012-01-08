<?php

// Register class loader
require_once __DIR__.'/../src/Growler/ClassLoader.php';
Growler\ClassLoader::register();

// Create components
$application = new Growler\Application("Test application");
$connection  = new Growler\Connection("udp", "localhost", 9887);
$transport   = new Growler\Transport\Udp($connection);
$notifier    = new Growler\Notifier($application, $transport);

// Register notification types
$type1      = new Growler\NotificationType("TYPE1");
$notifier->registerNotification($type1);

// Send notifications
$notifier->sendNotification(new Growler\Notification($type1, "Notification title", "Notification message"));
$notifier->sendNotification(new Growler\Notification($type1, "Notification title2", "Notification message2"));