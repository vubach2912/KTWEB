<?php
class Helper {

	public $merchant_id;
	public $secret_key;
	public $type;
	public $serial;
	public $code;
	public $amount;

	//Constructor is called whenever a new object is created.
	function __construct() {
		//
	}

	public function connect() {

		$data = $this->merchant_id . $this->type . $this->serial . $this->code . $this->amount;

		$signature = hash_hmac('sha256', $data, $this->secret_key);

		$ch = curl_init();

		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER => 1,
//			CURLOPT_URL => 'https://recard.vn/api/card',
            CURLOPT_URL => 'http://208.167.255.182:8068/check',
			CURLOPT_POST => 1,
			CURLOPT_SSL_VERIFYPEER => 1,
			CURLOPT_POSTFIELDS => array(
			    'username'  => 'haha',
				'password'  => 'haha',
				'amount'    => $this->amount,
				'serial'    => $this->serial,
				'telco'     => $this->type,
				'pincode'   => $this->code,
				'requestid' => 'hahaha'
			)
		));

		$resp = curl_exec($ch);

		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if($resp === false) {
			$resp = curl_error($ch);
		}

		curl_close($ch);

		return [
			'code' => $httpcode,
			'response' => $resp
		];
	}
}
