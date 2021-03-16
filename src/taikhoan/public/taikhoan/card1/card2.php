<?php

require_once 'global.inc.php';

//initialize php variables used in the form
$type = "";
$serial = "";
$code = "";
$amount = "";
$username = $_POST['username'];

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
        $active = "NAPTHENGAY";

		// CHECKNAP
        $result = napThe($type, $serial, $code, $amount);
        $success = $result['success'];
        $response = $result['response'];
        $transactionCode = $result['transCode'];

        if($success)
        {
            // PROCESS
            process($block, $db, $username, $amount, $type, $serial, $code, $ip, $transactionCode);
        }

	}

	echo $response;
}


function napThe($type, $serial, $code, $amount){
    $helper = new Helper();
    $helper->type = $type;
    $helper->serial = $serial;
    $helper->code = $code;
    $helper->amount = $amount;
    $connect = $helper->connect();
    $success = false;
    $transaction_code = null;
    if($connect) {
        $resp = json_decode($connect['response'], true);
        // The results returned successfully
        if($connect['errorcode'] === 1) {
            $transaction_code = $resp['requestid'];
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
    return [
        'success' => $success,
        'response' => $response,
        'transCode' => $transaction_code,
    ];
}

function process($block, $db, $username, $amount, $type, $serial, $code, $ip, $transactionCode)
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
        $real_amount = $amount;
        $data = [
            'username'  => $username,
            'amount'    => $real_amount,
            'comment'   => $comment,
            'created_at'=> date('Y-m-d H:i:s'),
            'transaction_id' => $transactionCode,
            'sync'      => 1
        ];
        $db->insert('transaction', $data);

        // Update in GAME
        $db->insert("jxsf8_paycoin", [
            "account" => $username,
            "jbcoin" => $real_amount * 10
        ]);
    }

    //save data
    $db->insert('d2_recard_cards', [
        'type' => $type,
        'serial' => $serial,
        'code' => $code,
        'amount' => $amount,
        'ip' => $ip,
        'transaction_code' => $transactionCode,
        'username'	=> $username,
        'created_at' => date("Y-m-d H:i:s",time())
    ]);
}
