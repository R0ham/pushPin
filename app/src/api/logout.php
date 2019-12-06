<?php
require_once 'http_error.php';
require_once '../db-auth/db_inc.php';
require_once '../db-auth/account_class.php';

session_start();

$account = new Account();

try {
    if ($account->sessionLogin()) {
        $account->logout();
        session_abort();
        header("Content-Type: text/json");
        echo '{"success": true}';
    }
} catch (Exception $e) {
    error(500, $e->getMessage());
}


