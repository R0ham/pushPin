<?php
require_once 'http_error.php';
require_once '../db-auth/db_inc.php';
require_once '../db-auth/account_class.php';

if ($_POST['password'] != $_POST['confirm']) {
    error(400, 'Passwords do not match');
    die();
}

$account = new Account();

try {
    $id = $account->addAccount($_POST['email'], $_POST['password']);
    header("Content-Type: text/json");
    echo '{"success": true}';
} catch (Exception $e) {
    error(400, $e->getMessage());
}
