<?php
//global.inc.php

header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Ho_Chi_Minh');
set_time_limit(0);

require 'vendor/autoload.php';
require_once 'includes/Medoo.php';
require_once 'includes/Helper.class.php';

use Medoo\Medoo;
use Automattic\WooCommerce\Client;

// config database
$db = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'pvpgn',
    'server' => 'db.diablo2-vn.com',
    'username' => 'pvpgn_connect',
    'password' => 'pvpgn1995123'
]);

$woocommerce = new Client(
    'https://manage.diablo2-vn.com', 
    'ck_9658abe0680247e953da846cc783d096059ff6ed', 
    'cs_399e72018e986a24745397679536e48b8bce85e0',
    [
        'version' => 'wc/v3',
    ]
);

// config API
$merchant_id = "f6ff92fe-e8a8-4841-9a47-853c6320087c";
$secret_key = "fXGOFVpYBdNQ";

date_default_timezone_set('Asia/Ho_Chi_Minh');
