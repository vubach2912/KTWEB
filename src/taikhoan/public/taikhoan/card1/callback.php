<?php 
//callback.php

require_once 'global.inc.php';

if(isset($_POST['secret_key']) && $secret_key == $_POST['secret_key']) {
	//retrieve the $_POST variables
	$transaction_code = $_POST['transaction_code'];
	$status = $_POST['status'];
	$amount = $_POST['amount'];
	
	//select data
	$card = $db->select("d2_recard_cards", "*", [
		"transaction_code" => $transaction_code
	]); 	
	
	if($card) {
		//success
		if($status == 1) {
		    $comment = 'DONATE FROM CARD '. $card[0]['code'];
            $block = $db->query("SELECT * FROM pvpgn_transaction WHERE comment = '" .$comment . "' LIMIT 1")->fetchAll();
            if(!$block) {
                $real_amount = $amount * 0.68;
                $data = [
                    'username'  => $card[0]['username'],
                    'amount'    => $real_amount,
                    'comment'   => $comment
                ];
                $db->insert('pvpgn_transaction', $data);

                $real_amount = $amount * 0.12;
                $data = [
                    'username'  => $card[0]['username'],
                    'amount'    => $real_amount,
                    'comment'   => 'DONATE BONUS FROM CARD '. $card[0]['code']
                ];
                $db->insert('pvpgn_transaction', $data);
            }
		} elseif ($status == 2) {
			$block = $db->query("SELECT * FROM d2_recard_block WHERE ip = '" . $card[0]['ip'] . "' LIMIT 1")->fetchAll();
			//update the results returned from the system
			$db->update("d2_recard_block", [
				"warning" => $block[0]['warning'] + 1,
			], [
				"ip" => $card[0]['ip']
			]);
		}		
	}

	//update the results returned from the system
	$db->update("d2_recard_cards", [
		"status" => $status,
		"amount" => $amount,
		"updated_at" => date("Y-m-d H:i:s",time())
	], [
		"transaction_code" => $transaction_code
	]);
	
}