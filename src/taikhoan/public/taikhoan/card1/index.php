<?php

if ($_GET['action'] == 'callback') {
    require_once 'callback.php';
} elseif ($_GET['action']  == 'nap' ) {
    require_once 'card2.php';
}
