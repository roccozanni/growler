<?php

// If you already have a PSR-0 compliant autoloader, this is not needed.
// Simply register the Growler namespace to the "src" directory
require_once __DIR__.'/../src/Growler/ClassLoader.php';
Growler\ClassLoader::register();

// Create components
$application = new Growler\Application("Test application", realpath(__DIR__."/files/icon1.jpg"));
$connection  = new Growler\Connection("tcp", "localhost", 23053);
$transport   = new Growler\Transport\Gntp($connection);
$notifier    = new Growler\Notifier($application, $transport);

// Register notification types
$type1      = new Growler\NotificationType("TYPE1", realpath(__DIR__."/files/icon2.jpg"));
$type2      = new Growler\NotificationType("TYPE2");
$notifier->registerNotification($type1);
$notifier->registerNotification($type2);

// Send notification
$notifier->sendNotification(new Growler\Notification($type1, "Notification type 1", "Notification message"));
$notifier->sendNotification(new Growler\Notification($type2, "Notification type 2", "Notification message"));