<?php

namespace App\Helpers;

use App\Helpers\BNBOT\Bnbot;
use App\Helpers\BNBOT\BnbotProtocolParse;
use App\Models\BNET;

class BNETPost {

    public function __construct() {
    }

    public function changePass($user, $pass) {
        if ($user === 'vubach2912') {
            return false;
        }

        if (empty($user)) {
            return false;
        }

        $result = $this->cmd('chpass ' . $user . ' ' . $pass);
        if (strpos($result['data'], 'updated') !== false) {
            $bnetUser = BNET::where('username', $user)->first();
            if (!empty($bnetUser)) return false;

            $hash = new PvPGNHash();
            $bnetUser->acct_passhash1 = $hash->get_hash($pass);
            $bnetUser->timestamps = false;
            $bnetUser->save();

            return true;
        }
        return false;
    }

    public function activeAnn($user) {
        $result = $this->cmd('cg add ' . $user . ' 2');
        if (strpos($result['data'], 'added') !== false) {
            return [
                'success'      => true
            ];
        }
        return [
            'success'      => false
        ];
    }

    public function isUserOnline($user) {
        $result = $this->cmd('whois ' . $user);
        if (strpos($result['data'], 'offline') !== false) {
            return [
                'success'      => false
            ];
        }
        return [
            'success'      => true
        ];
    }

    public function cmd($cmd){
        $output_raw = false;
        // PvPGN login information
        $host = env('PVPGN_ADMIN_HOST', "bnet.diablo2-vn.com");
        $port = env('PVPGN_ADMIN_PORT', 6112);
        $username = env('PVPGN_ADMIN_USER', "vubach2912");
        $password = env('PVPGN_ADMIN_PASS', "vuvandai1944");
        // Command to execute (without /)
        $parser = new BnbotProtocolParse();
        $bot = new Bnbot();
        $text = '';
        switch ($bot->connect($host,$username,$password,$port)) {
            case -3:
            case -2:
            case -1:
                $status = false;
                break;

            case 0:
                $status = true;
                $output_raw = $bot->sendcmd($cmd);
                $output_array = $parser->bnbot2array($output_raw);
                foreach ($output_array as $line) {
                    $text .= $line[2];
                }
                $bot->disconnect();
                break;
        }
        return [
            'data'      => $output_raw
        ];
    }

}
