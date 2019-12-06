<?php
require_once '../db-auth/db_inc.php';
require_once '../db-auth/account_class.php';

require_once 'http_error.php';

require_once'../db-auth/account_class.php';
require_once '../db-auth/db_inc.php';

session_start();

$account = new Account();
header("Content-Type: text/json");
try {
    if ($account->sessionLogin()) {
        $username = $account->getUserName();
        echo "{\"success\": \"true\", \"username\": \"" . $username . "\"}";
    } else {
        echo "{\"success\": \"false\"}";
    }
} catch (Exception $e) {
    error(500, $e);
}