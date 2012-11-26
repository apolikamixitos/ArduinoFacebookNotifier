<?php
//You need to use serproxy to communicate with your device
class FBSerialComm{
	private $Handler;
	private $Host;
	private $Port;

	public function __construct($Host,$Port){
	$this->Host = $Host;
	$this->Port = $Port;
	$this->Handler = fsockopen($this->Host, $this->Port, $errno, $errstr) or die('Error('.$errno.'): '.$errstr);
	}
	
	public function UpdateFriendRequests($NbrFReq){
		fputs($this->Handler, "FREQ:".$NbrFReq."\n");
	}
	
	public function UpdateNotifications($NbrNotif){
		fputs($this->Handler, "NOTIF:".$NbrNotif."\n");
	}
	
	public function UpdateMessages($NbrMsgs){
		fputs($this->Handler, "MSGS:".$NbrMsgs."\n");
	}
	
	public function Close(){
		fclose($this->Handler);
		$this->Handler=null;
	}
	
}
?>