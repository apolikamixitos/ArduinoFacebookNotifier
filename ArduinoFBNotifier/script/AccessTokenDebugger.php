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

require 'Configuration.php';
require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => null,
  'secret' => null
));
$facebook->setAccessToken(ACCESS_TOKEN);

$user = $facebook->getUser();

if ($user) {
  try {
  
    //Get the token info
    $tokeninfo = $facebook->api('/debug_token?input_token='.ACCESS_TOKEN);
	echo "Access Token : ".ACCESS_TOKEN;
	echo "\n\nApplication : ".$tokeninfo['data']['application'];
	echo "\nUserID : ".$tokeninfo['data']['user_id'];
	echo "\nStatus : ".(($tokeninfo['data']['is_valid'])?'Valid':'Invalid');
	echo "\nIssued at : ".date("Y-m-d H:i:s",$tokeninfo['data']['issued_at']);
	echo "\nExpires at : ".date("Y-m-d H:i:s",$tokeninfo['data']['expires_at']);

  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

System("PAUSE");

?>
