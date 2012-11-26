<?php
/**
 * Copyright 2011 Facebook, Inc.
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

require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => 'YOUR_FACEBOOK_APP_ID',
  'secret' => 'YOUR_FACEBOOK_APP_SECRET',
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

//Check if the user has an access token, if not a login link will be shown to log into his account
$token = $facebook->getAccessToken();
if(!empty($token) && ctype_alnum($token))
	echo "Your access token : ".$token."<br><br><br>";
else
	echo "<a href='".$facebook->getLoginUrl(array('scope' => 'read_requests, manage_notifications,read_mailbox, offline_access'))."'>Get your access token from AndroidFBNotifier</a>";

?>
