<?php

namespace App\Notify;

use App\Jobs\SendKudiSMS;
use App\Lib\CurlRequest;
use MessageBird\Client as MessageBirdClient;
use MessageBird\Objects\Message;
use Textmagic\Services\TextmagicRestClient;
use Twilio\Rest\Client;
use Vonage\Client as NexmoClient;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class SmsGateway{

    /**
     * the number where the sms will send
     *
     * @var string
     */
    public $to;

    /**
     * the name where from the sms will send
     *
     * @var string
     */
    public $from;
    public $smstype;


    /**
     * the message which will be send
     *
     * @var string
     */
    public $message;


    /**
     * the configuration of sms gateway
     *
     * @var object
     */
    public $config;

	public function clickatell()
	{
		$message = urlencode($this->message);
		$api_key = $this->config->clickatell->api_key;
		@file_get_contents("https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=$this->to&content=$message");
	}

	public function infobip(){
		$message = urlencode($this->message);
		@file_get_contents("https://api.infobip.com/api/v3/sendsms/plain?user=".$this->config->infobip->username."&password=".$this->config->infobip->password."&sender=$this->from&SMSText=$message&GSM=$this->to&type=longSMS");
	}

	public function bulksmsng(){
		$message = urlencode($this->message);
		@file_get_contents("https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=".$this->config->bulksmsng->token."&from=".$this->config->bulksmsng->sender."&to=$this->to&body=$message&dnd=2");
	}

	public function messageBird(){
		$MessageBird = new MessageBirdClient($this->config->message_bird->api_key);
	  	$Message = new Message();
	  	$Message->originator = $this->from;
	  	$Message->recipients = array($this->to);
	  	$Message->body = $this->message;
	  	$MessageBird->messages->create($Message);
	}

	public function nexmo(){
		$basic  = new Basic($this->config->nexmo->api_key, $this->config->nexmo->api_secret);
		$client = new NexmoClient($basic);
		$response = $client->sms()->send(
		    new SMS($this->to, $this->from, $this->message)
		);
		 $response->current();
	}

	public function smsBroadcast(){
		$message = urlencode($this->message);
		@file_get_contents("https://api.smsbroadcast.com.au/api-adv.php?username=".$this->config->sms_broadcast->username."&password=".$this->config->sms_broadcast->password."&to=$this->to&from=$this->fromName&message=$message&ref=112233&maxsplit=5&delay=15");
	}

	public function kudisms(){
		$message = $this->message;
        if (strpos($this->to, '0') === 0) {
            $this->to = '234' . substr($this->to, 1);
        }
        
        SendKudiSMS::dispatch($this->config->kudisms, $this->to, $message, $this->smstype);
	}
    public function sendkudiwhatsapp($kudisms, $mobile,$message)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://my.kudisms.net/api/whatsapp',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'token='.$kudisms->api_key.
                '&recipient='.$mobile.
                '&template_code='.$kudisms->whatsapptemplatecode.
                '&parameters='.$message.
                '&button_parameters=xxxx%2Cxxxx%2Cxxx
                &header_parameters=xxxx%2Cxxxx',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            dd("cURL Error #:" . $err);
             echo "cURL Error #:" . $err;
            return [];
        }
        $reply = json_decode($response,true);
//        dd($reply);
        return $reply;
    }
    public function sendkudiotp($kudisms, $mobile,$message)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://my.kudisms.net/api/otp?token=xxx&senderID=xxx&recipients=xxx&otp=xxx&appnamecode=xxx&templatecode=xxx',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "token": "'. $kudisms->api_key.'",
                "senderID": "'.$kudisms->sender.'",
                "recipients": "'.$mobile.'",
                "otp": "'.$message.'",
                "appnamecode": "'.$kudisms->appnamecode.'",
                "templatecode": "'.$kudisms->smstemplatecode.'"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: text/plain'
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
//            dd("cURL Error #:" . $err);
             echo "cURL Error #:" . $err;
            return [];
        }
        $reply = json_decode($response,true);
//        dd($reply);
        return $reply;
    }
    public function sendkudibroadcast($kudisms, $mobile,$message)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://my.kudisms.net/api/corporate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'token' => $kudisms->api_key,
                'senderID' => $kudisms->sender,
                'recipients' => $mobile,
                'message' => $message,
                'gateway' => '2'),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
//            dd("cURL Error #:" . $err);
             echo "cURL Error #:" . $err;
            return [];
        }
        $reply = json_decode($response,true);
//        dd($reply);
        return $reply;
    }
	public function twilio(){
		$account_sid = $this->config->twilio->account_sid;
		$auth_token = $this->config->twilio->auth_token;
		$twilio_number = $this->config->twilio->from;

		$client = new Client($account_sid, $auth_token);
		$client->messages->create(
		    '+'.$this->to,
		    array(
		        'from' => $twilio_number,
		        'body' => $this->message
		    )
		);
	}

	public function textMagic(){
        $client = new TextmagicRestClient($this->config->text_magic->username, $this->config->text_magic->apiv2_key);
        $client->messages->create(
            array(
                'text' => $this->message,
                'phones' => $this->to
            )
        );
	}

	public function custom(){
		$credential = $this->config->custom;
		$method = $credential->method;
		$shortCodes = [
			'{{message}}'=>$this->message,
			'{{number}}'=>$this->to,
		];
		$body = array_combine($credential->body->name,$credential->body->value);
		foreach ($body as $key => $value) {
			$bodyData = str_replace($value,@$shortCodes[$value] ?? $value ,$value);
			$body[$key] = $bodyData;
		}
		$header = array_combine($credential->headers->name,$credential->headers->value);
		if ($method == 'get') {
			$credential->url.'?'.http_build_query($body);
			CurlRequest::curlContent($credential->url,$body,$header);
		}else{
			CurlRequest::curlPostContent($credential->url,$body,$header);
		}
	}

    public function kudiwhatsap(){
		$credential = $this->config->custom;
		$method = $credential->method;
		$shortCodes = [
			'{{message}}'=>$this->message,
			'{{number}}'=>$this->to,
		];
		$body = array_combine($credential->body->name,$credential->body->value);
		foreach ($body as $key => $value) {
			$bodyData = str_replace($value,@$shortCodes[$value] ?? $value ,$value);
			$body[$key] = $bodyData;
		}
		$header = array_combine($credential->headers->name,$credential->headers->value);
		if ($method == 'get') {
			$credential->url.'?'.http_build_query($body);
			CurlRequest::curlContent($credential->url,$body,$header);
		}else{
			CurlRequest::curlPostContent($credential->url,$body,$header);
		}
	}
}
