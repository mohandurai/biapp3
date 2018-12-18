<?php
/*
 * @Author: Akshay Agarwal
 * 
 * This is the class for implementing SMS Country gateway
 * 
 * @implements: SMS Interface
 */



class SMSInfini{
	
	/*
	 * array Stores the gateway config params such as username, password etc.
	 */
	private $gateway_config;
	private static $base_url = "alerts.sinfini.com/api/web2sms.php";
	private $post_fields;
	private $response;
	private $url;
	
	/*
	 * @param: $to number in international format with leading + 
	 */
	public function sendSingleSMS($senderID,$to,$message){
		//$ch = SMSInfini::$base_url;
		$to=implode(",",$to);
		$this->post_fields['workingkey'] = "600832t7bf2493yi0in7";  // changed from "N" to "N_UDH"
		$this->post_fields['port'] = "50001"; // added by venu
		$this->post_fields['sender'] = $senderID;
		$this->post_fields['to'] = $this->sanitise_number($to);
		$this->post_fields['message'] = $message;
		//return $this->post_fields;
		print_r($ch);
		return $this->fireurl($ch);
	}
	
	public function fireurl($params)
	{
			$ch=curl_init();
			$url=SMSInfini::$base_url.'?'.http_build_query($this->post_fields);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$output=curl_exec($ch);
			curl_close($ch);                                
			return $output;
		
	}
	
	public function sendSingleScheduledSMS($senderID,$to,$message,$timestamp){
		$ch = $this->initiate_connection("apisetreminder.asp");
		$this->post_fields['sendername'] = $senderID;
		$this->post_fields['mobilenumber'] = $this->sanitise_number($to);
		$this->post_fields['message'] = $message;
		$this->post_fields['schedulername'] = $senderID . "-" . $timestamp; 
		$this->post_fields['scheduleddatetime'] = $this->tsTodt($timestamp);
		$this->post_fields['systemcurrenttime'] = $this->tsTodt(time());
		$this->post_fields['interval'] = urlencode("0");
		return $this->get_response($ch);
	}
	
	public function sendBulkSMS($senderID,$to_list,$message){
		array_walk($to_list, array($this,"sanitise_number"));
		$numbers = implode(",", $to_list);
		$ch = $this->initiate_connection("smscwebservice_bulk.aspx");
		$this->post_fields['mtype'] = "N";
		$this->post_fields['sid'] = $senderID;
		$this->post_fields['mobilenumber'] = $numbers;
		$this->post_fields['message'] = $message;
		return $this->get_response($ch);
	}
	
	/*
	 * @param $to_list array containing numbers
	 */
	public function sendBulkScheduledSMS($senderID,$to_list,$message,$timestamp){
		array_walk($to_list, array($this,"sanitise_number"));
		$numbers = implode(",", $to_list);
        //print_r($numbers);
		$ch = $this->initiate_connection("apisetreminder.asp");
		$this->post_fields['sendername'] = $senderID;
		$this->post_fields['mobilenumber'] = $numbers;
		$this->post_fields['message'] = $message;
		$this->post_fields['schedulername'] = $senderID . "-" . $timestamp;
		$this->post_fields['scheduleddatetime'] = $this->tsTodt($timestamp-120);
		$this->post_fields['systemcurrenttime'] = $this->tsTodt(time()+19800);
		$this->post_fields['interval'] = urlencode("0");
		return $this->get_response($ch);
	}
	
	private function initiate_connection($file){
		$this->gateway_config = array();
		/*
		 * TODO: change this to configure according to user provided values
		 */
		$this->gateway_config['username'] = "maxrsa";
		$this->gateway_config['password'] = "rsa2012";
		$this->gateway_config['delivery_reports'] = "Y";
		 
		$ch = curl_init();
		$this->url = SMSCountry::$base_url .'/'. $file;
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$this->post_fields = array();
		$this->post_fields['user'] = urlencode($this->gateway_config['username']);
		$this->post_fields['passwd'] = urlencode($this->gateway_config['password']);
		$this->post_fields['dr'] = urlencode($this->gateway_config['delivery_reports']);
		
		return $ch;
	}
	
	private function get_response($ch){
		
		curl_setopt($ch, CURLOPT_URL, $this->url .'?'. http_build_query($this->post_fields));
		$this->response = curl_exec($ch);
		return $this->response;
	}
	
	private function sanitise_number(&$number){
		return preg_replace("/\+/","",$number);
	}
	
	/*
	 * Converts given timestamp to requried dateTime format of SMSCountry
	 */
	private function tsTodt($timestamp){
		$dt = date("d/m/y h:i:s A",$timestamp);
		return $dt;
	} 
}