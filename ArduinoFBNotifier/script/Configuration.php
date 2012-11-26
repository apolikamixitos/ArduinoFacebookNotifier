<?php
/**
 * Copyright 2012 Apolikamixitos (Ayoub DARDORY).
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
 ///Twitter : http://www.twitter.com/Apolikamixitos
 ///GitHub: http://github.com/apolikamixitos


//Your Facebook access token
//You can generate your own code
define('ACCESS_TOKEN','');
define('SLEEP_TIME',10); //Seconds to wait before checking again

//Configure the file 'serproxy.cfg' in 'serialcomm' folder to communicate with Arduino
define('SERPROXY_HOST','localhost'); //Host of the 'serproxy' server
define('SERPROXY_PORT',5332); //Port of 'serproxy' server


//You can disable some of the checkings
define('CHECK_INBOX',false); //To check messages
define('CHECK_NOTIFICATIONS',true); //To check notifications
define('CHECK_FRIENDREQUESTS',true);//To check friendrequests



?>