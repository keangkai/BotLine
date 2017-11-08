<?php
class MessageController{
	private $access_token='bMxLi6kKTa/Lt23ZIVLnt67TZHHdbYKiUxaycIMoNWp5VmLQ6tgc2rQT931RmJXdx2gA24/cf/sFpV84O1uOmSPHspwy0OLWXKodwnlwh8SLO44dopDMxUWPIIxJzlB14bs6IjfOHlR932hlgtUETgdB04t89/1O/w1cDnyilFU=';
    public function getMessage(){
		header('Content-Type: text/html; charset=utf-8');
		$content=file_get_contents('php://input');
		$events=json_decode($content,true);
		if(!is_null($events['events'])) {
			foreach($events['events'] as $event){
				if($event['type']=='message'&&$event['message']['type']=='text'){
					$text = $event['message']['text'];
					$replyToken = $event['replyToken'];
					if(strpos($text,'Hi')!==FALSE){
						$textSend="Hello";
					}else if (strpos($text,'name')!==FALSE) {
						$textSend="my name is Gun";
					}else if (strpos($text,'old')!==FALSE) {
						$textSend="I'm 20 years old";
					}else if (strpos($text,'ROV')!==FALSE) {
						$textSend="You are noob!";
					}else if (strpos($text,'scream')!==FALSE) {
						$textSend="OH shit!";
					}else if (strpos($text,'beautiful')!==FALSE) {
						$textSend="Gun";
					}else if (strpos($text,'give')!==FALSE) {
						$textSend="Thank you so much!";
					}else if (strpos($text,'sing')!==FALSE) {
						$textSend="sing with me everyday";
					}else{
						$textSend="Why you ask me?";
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