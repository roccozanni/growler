<?php

// Register class loader
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

// Send notifications
$notifier->sendNotification(new Growler\Notification($type1, "Notification type 1", "A message with notification type custom icon"));
$notifier->sendNotification(new Growler\Notification($type2, "Notification type 2", "A message with application default icon"));
$notifier->sendNotification(new Growler\Notification($type2, "Notification type 2", "A message with notificaton custom icon", realpath(__DIR__."/files/icon3.jpg")));