Growler - A pure PHP Growl notification library
=============================

[![Build Status](https://secure.travis-ci.org/roccozanni/growler.png)](http://travis-ci.org/roccozanni/growler)

UDP protocol
-----

Historical versions of Growl (< 1.3), listen to the UDP port 9887 for incoming messages that represents notifications to display

The protocol is very simple:
- supports only title and message, no custom icon
- on the same socket you can send as many messages as you want, no response from the other side

The UDP procol implementation is completed.

GNTP protocol
-----

From Growl 1.3 has been introduced the new TCP-based GNTP protocol.

GNTP is a protocol to allow two-way communication between applications and centralized notification systems such as Growl for Mac OS X and to allow two-way communication between two machines running centralized notification systems for notification forwarding purposes.

A the moment, the GNTP procol support is very basic and only a subset of the features are currently implemented.

Missing:
- Custom icons
- Encryption and password
- Subscribing and callbacks


Other TODOs
-----

- Logging
- Error handling
- A Facade for simpler use out-of-the-box