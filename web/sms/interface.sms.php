<?php
/*
 * @author: Akshay Agarwal 
 * @website: http://akshayagarwal.in
 * 
 * This is the interface for two way sms. All gateways should extend from this interface
 * and implement their sms logic
 */
interface SMS {
	public function sendSingleSMS($senderID,$to,$message);
	public function sendSingleScheduledSMS($senderID,$to,$message,$timestamp);
	public function sendBulkSMS($senderID,$to_list,$message);
	public function sendBulkScheduledSMS($senderID,$to_list,$message,$timestamp);
}
?>