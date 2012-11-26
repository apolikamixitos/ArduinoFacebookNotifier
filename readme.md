Arduino Facebook Notifier (v.0.1.1)
==========================

The [Arduino Facebook Notifier](http://developers.facebook.com/) is
a tool that make you intercat with Arduino and Facebook.

This repository contains the open source PHP that allows you to
access Facebook from a PHP app and connect with your Arduino. Except as otherwise noted,
the Arduino Facebook Notifier PHP is licensed under the Apache Licence, Version 2.0
(http://www.apache.org/licenses/LICENSE-2.0.html).

Overview
--------

**Arduino Facebook Notifier** allows you to get the basic information from your Facebook account.

In this first version, you can use your Arduino board to get notified of any new friend request, message or notification.

Demonstration video : [http://www.youtube.com/watch?v=Q9Ol_oU0jaE](http://www.youtube.com/watch?v=Q9Ol_oU0jaE)

Installation
------------

1. Compile and upload the source code on your Arduino board.

2. Put 3 LEDs on 3 different pins :
	+ Friend requests: Pin8
	+ Messages: Pin10
	+ Notifications: Pin12

Configuration
------------

###TinkerProxy Configuration (Serial Communication Proxy):

You can configure the COMPort and other additional proxy settings of TinkerProxy in the file found in "tools/serialcom/serproxy.cfg".

**Example:**
```
	# Comm ports used
	comm_ports=2

	# Default settings
	comm_baud=9600
	comm_databits=8
	comm_stopbits=1
	comm_parity=none

	# Idle time out in seconds
	timeout=0
	
	# Port 2 settings (ttyS1)
	net_port2=5332
```

###Facebook Checker Configuration:

You may change the settings of the configuration file found in "script/Configuration.php".

####Change TinkerProxy Connection settings:

You specify the host and the port.

```php
define('SERPROXY_HOST','localhost'); //Host of the 'serproxy' server
define('SERPROXY_PORT',5332); //Port of 'serproxy' server
```

####Facebook account 'Access_Token':

1. Create a Facebook application (http://developers.facebook.com/apps)
2. Edit the file "script/AccessTokenGetter.php" with your Facebook application ID and Facebook application secret
3. Upload it to the Site URL you specified in your Facebook application settings ('localhost' is also allowed)
4. Open it and generate the 'access_token'
5. Place it in 'Configuration.php'
	
**_N.B:_** During the login a 'offline__access' permission is required so the access_token won't expire early (2 months TTL). 
	
####Additional settings

+ 'CHECK' Options: You can disable or enable some of the options (FriendRequests, Notifications or Messages).

+ SleepTime: Delay between each call (5 seconds min). Recommendation: If the SleepTime is higher than 20s, you may not exceed the Facebook API limit.

Usage
-----

####Arduino Facebook Notifier (ArduinoFBNotifier)

This batch file will start 'TinkerProxy' and the execution of the PHP Script.

####Facebook access token debugger (AccessTokenDebugger)

With this tools you can debug your Facebook access__token to know if it's still valid, when it expires and other related information.

Tools
-----

The tools that have been used on this project :

+ Arduino UNO R3 Board
+ PHP 5.3.13
+ Facebook PHP SDK (http://github.com/facebook/facebook-php-sdk)
+ TinkerProxy v2.0 (http://code.google.com/p/tinkerit/wiki/TinkerProxy)


Contributing
===========
For us to accept contributions you will have to first have signed the
[Contributor License Agreement](http://en.wikipedia.org/wiki/Contributor_License_Agreement).

When commiting, keep all lines to less than 80 characters, and try to
follow the existing style.

Before creating a pull request, squash your commits into a single commit.

Add the comments where needed, and provide ample explanation in the
commit message.


Report Issues/Bugs
===============
[Bugs]()

[Questions]()
