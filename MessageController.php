<?php
class MessageController{
	private $access_token='VJ8i3lMy15kBCd529KumsFjx9WszyoOWHfAUCs8uJru0UQLYLV013gw2EwEBjMcpLL3pocDSLDlqNwq6gxjaIuU6vXyJS6nUpjzKnmljerB2AiGyudUiofKPyWxMxqsNr2XDz7FyZJVxHD3zvHu3XgdB04t89/1O/w1cDnyilFU=';
    public function getMessage(){
		header('Content-Type: text/html; charset=utf-8');
		$content = file_get_contents('php://input');
		$events = json_decode($content,true);
	    	$events = strtolower("$content");
		if(!is_null($events['events'])) {
			foreach($events['events'] as $event){
				if($event['type']=='message'&&$event['message']['type']=='text'){
					$text = $event['message']['text'];
					$replyToken = $event['replyToken'];
					if(strpos($text,'สวัสดี')!==FALSE){
						$textSend="สวัสดีงับ";
					}else if (strpos($text,'ชื่อ')!==FALSE) {
						$textSend="เราชื่อเกมส์";
					}else if (strpos($text,'อายุ')!==FALSE) {
						$textSend="เราอายุเท่าเธอ";
					}else if (strpos($text,'ROV')!==FALSE) {
						$textSend="นายมันกระจอกสิ้นดี";
					}else if (strpos($text,'โง่')!==FALSE) {
						$textSend="โถ เราแค่อ่อนให้";
					}else if (strpos($text,'หล่อ')!==FALSE) {
						$textSend="เรารู้ตัว";
					}else if (strpos($text,'give')!==FALSE) {
						$textSend="Thank you so much!";
					}else if (strpos($text,'sing')!==FALSE) {
						$textSend="sing with me everyday";
					}
					else if (strpos($text,'sing')!==FALSE) {
						$textSend="sing with me everyday";
					}else{
						$textSend="ฉันไม่รู็ว่าคุณหมายถึงอะไร เชิญถาม Google";
					}
					$this->sendMessage($textSend,$replyToken);
					break;
				}
			}
		}
    }

    public function sendMessage($textSend,$replyToken){
		$messages=[
			'type'=>'text',
			'text'=>$textSend
		];
		$url='https://api.line.me/v2/bot/message/reply';
		$data=[
			'replyToken'=>$replyToken,
			'messages'=>[$messages]
		];
		$post=json_encode($data);
		$headers=array('Content-Type: application/json','Authorization: Bearer '.$this->access_token);
		$ch=curl_init($url);
		curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"POST");
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
		curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
		curl_exec($ch);
		curl_close($ch);
    }
}
