<?php
/**
 * Copyright 2012 Apolikamixitos (Ayoub DARDORY)
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
require 'src/FBSerialComm.php';
require 'src/facebook.php';

set_time_limit(0);

$facebook = new Facebook(array('appId'  => null,'secret'=>null));

$facebook->setAccessToken(ACCESS_TOKEN);

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid.
while(true){
if ($user) {
  try {
    //echo "\nUSER FOUND";

	//We set the fields that we will use to get the needed information
	//friendrequests.fields(unread): to get unread friend requests (requires 'read_requests' permission)
	//notifications: to get notifications (requires 'manage_notifications' permission)
	//inbox: to get mails (requires 'read_mailbox' permission)
	
	//You can disable some of the checking from the configuration file (Configuration.php)
	$req="";
	if(CHECK_INBOX==true)
		$req .= "inbox";
	if(CHECK_NOTIFICATIONS==true){
		$req .=(!empty($req))?',':'';
		$req .= "notifications";
	}
	if(CHECK_FRIENDREQUESTS==true){
		$req .=(!empty($req))?',':'';
		$req .= "friendrequests.fields(unread)";
	}
	
	$res = $facebook->api('/me?fields='.$req);

	$NbrFriendRequests = (isset($res['friendrequests']['summary']['unread_count']))?$res['friendrequests']['summary']['unread_count']:0;
	$Nbrotifications = (isset($res['notifications']['summary']['unseen_count']))?$res['notifications']['summary']['unseen_count']:0;
	$NbrInbox = (isset($res['inbox']['summary']['unseen_count']))?$res['inbox']['summary']['unseen_count']:0;
	
	echo "\nFREQ : ".$NbrFriendRequests;
	echo "\nNOTIF : ".$Nbrotifications;
	echo "\nMSGS : ".$NbrInbox;

	//Sending commands to the Arduino board
	$FB = new FBSerialComm(SERPROXY_HOST,SERPROXY_PORT);
	$FB->UpdateFriendRequests($NbrFriendRequests);
	$FB->UpdateNotifications($Nbrotifications);
	$FB->UpdateMessages($NbrInbox);
	$FB->Close();
	
  } catch (FacebookApiException $e) {
	error_log($e);
	echo "\nAn exception has occured, Please check your internet connection or try to generate a new access token.";
	continue;
	//System("PAUSE");
  }
}else{
echo "\nNO USER FOUND, Please generate your access token.";
}
sleep(SLEEP_TIME);
}
Sytem("PAUSE");
?>
