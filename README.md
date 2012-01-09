Growler - A pure PHP Growl notification library
=============================

[![Build Status](https://secure.travis-ci.org/roccozanni/growler.png)](http://travis-ci.org/roccozanni/growler)

Class loading
-----

If you have installed the package with composer, it will provide autoloading feature:

    require_once 'vendor/.composer/autoload.php';

Otherwise, if you already use in your project a PSR-0 compliant autoloader, simply register the "Growler" namespace:

    // This is based on the Symfony2 Class Loader
    $loader->registerNamespace('Growler', 'growler/src');

Otherwise, a basic autoloader is included in the Growler distribution:

    require_once 'growler/src/Growler/ClassLoader.php';
    Growler\ClassLoader::register();

UDP protocol
-----

Historical versions of Growl (< 1.3), listen to the UDP port 9887 for incoming messages that represents notifications to display

The protocol is very simple:

- supports only title and message, no custom icon
- on the same socket you can send as many messages as you want, no response from the other side

The UDP procol implementation is feature-complete.

This is an example for creating a UDP based transport:

    $connection  = new Growler\Connection("udp", "localhost", 9887);
    $transport   = new Growler\Transport\Udp($connection);

GNTP protocol
-----

From Growl 1.3 has been introduced the new TCP-based GNTP protocol.

GNTP is a protocol to allow two-way communication between applications and centralized notification systems such as Growl for Mac OS X and to allow two-way communication between two machines running centralized notification systems for notification forwarding purposes.

The GNTP procol implementation is NOT feature-complete yet.

Missing:

- Message encryption
- Subscribing and callbacks

This is an example for creating a GNTP based transport:

    $connection  = new Growler\Connection("tcp", "localhost", 23053);
    $transport   = new Growler\Transport\Gntp($connection);

Other TODOs
-----

- Logging
- Error handling
- A Facade for simpler use out-of-the-box


Examples
-----

Code samples are available in the "examples" directory
