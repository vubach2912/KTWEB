<?php

require_once 'global.inc.php';

//initialize php variables used in the form
$type = "";
$serial = "";
$code = "";
$amount = "";
$username = $_POST['username'];
$getContact = $db->query("SELECT * FROM pvpgn_BNET WHERE username = '" . $username . "' LIMIT 1")->fetchAll();
if (empty($getContact[0])) {
	$output = [
		'merchant_id' => 'Tên tài khoản không tồn tại trong hệ thống, vui lòng đăng ký tài khoản trong game'
	];
	$response = json_encode($output);
	echo $response;
	die();
}

//check to see that the form has been submitted
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && empty($response)) {

	//retrieve the $_POST variables
	$type = $_POST['type'];
	$serial = $_POST['serial'];
	$code = $_POST['code'];
	$amount = $_POST['amount'];
    $username = $_POST['username'];
	$ip = $_SERVER['REMOTE_ADDR'];

    $block = $db->query("SELECT * FROM d2_recard_block WHERE ip = '" . $ip . "' LIMIT 1")->fetchAll();

	if($block && $block[0]['warning'] >= 3) {

		$output = [
			'merchant_id' => 'Bạn đã nạp sai quá 3 lần. Không được phép nạp thẻ nữa.'
		];

		$response = json_encode($output);
	} else {
		//initialize variables for form validation
		$success = false;
        $active = "NAPTHENGAY";

		// RECARD
		if ($active == "RECARD") {
            $helper = new Helper();

            $helper->merchant_id = $merchant_id;
            $helper->secret_key = $secret_key;
            $helper->type = $type;
            $helper->serial = $serial;
            $helper->code = $code;
            $helper->amount = $amount;

            $connect = $helper->connect();

            if($connect) {

                $resp = json_decode($connect['response'], true);

                // The results returned successfully
                if($connect['code'] === 200 && $resp['success'] == 1) {
                    $transaction_code = $resp['transaction_code'];
                    $output = [
                        'success' => 1
                    ];
                    $response = json_encode($output);
                    $success = true;
                } else {
                    $response = $connect['response'];
                }

            } else {
                $output = [
                    'merchant_id' => 'Kết nối đến hệ thống bị gián đoạn'
                ];
                $response = json_encode($output);
            }
        }

        if ($active == "NAPTHENGAY") {
            $merchant_id = '4360';
            $api_email = 'vubach2912@gmail.com';
            $secure_code = '17460d797e3ffc022d3645c71d11c8dc';
            $transaction_code = time();
            $api_url = 'http://api.napthengay.com/v2/';
            $arrayPost = array(
                'merchant_id'=>intval($merchant_id),
                'api_email'=>trim($api_email),
                'trans_id'=>trim($transaction_code),
                'card_id'=>trim($type),
                'card_value'=> intval($amount),
                'pin_field'=>trim($code),
                'seri_field'=>trim($serial),
                'algo_mode'=>'hmac'
            );

            $data_sign = hash_hmac('SHA1',implode('',$arrayPost),$secure_code);
            $arrayPost['data_sign'] = $data_sign;
            $curl = curl_init($api_url);
            curl_setopt_array($curl, array(
                CURLOPT_POST=>true,
                CURLOPT_HEADER=>false,
                CURLINFO_HEADER_OUT=>true,
                CURLOPT_TIMEOUT=>120,
                CURLOPT_RETURNTRANSFER=>true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POSTFIELDS=>http_build_query($arrayPost)
            ));
            $data = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $result = json_decode($data,true);
            $time = time();
            if ($result['code'] == 100) {
                $success = true;
                $output = [
                    'success' => 1
                ];
            } else {
                $output = [
                    'merchant_id' => $result['msg']
                ];
            }
            $response = json_encode($output);
        }

		if($success)
		{

			if(!$block) {
				//save data
				$db->insert('d2_recard_block', [
					'ip' => $ip
				]);
			}

            $comment = 'DONATE FROM CARD '. $code;
            $block = $db->query("SELECT * FROM `transaction` WHERE comment = '" .$comment . "' LIMIT 1")->fetchAll();
            if(!$block) {
                $real_amount = $amount * 0.8;
                $data = [
                    'username'  => $username,
                    'amount'    => $real_amount,
                    'comment'   => $comment,
                    'sync'      => 1
                ];
                $db->insert('pvpgn_transaction', $data);
            }
			//save data
			$db->insert('d2_recard_cards', [
				'type' => $type,
				'serial' => $serial,
				'code' => $code,
				'amount' => $amount,
				'ip' => $ip,
				'transaction_code' => $transaction_code,
				'username'	=> $username,
				'created_at' => date("Y-m-d H:i:s",time())
			]);
		}
	}

	echo $response;
}
