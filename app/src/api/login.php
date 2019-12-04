<?php

require_once 'http_error.php';

require_once'../db-auth/account_class.php';
require_once '../db-auth/db_inc.php';

$username = $_POST['username'];
$password = $_POST['password'];

$account = new Account();

try {
    if ($account->login($username, $password)) {
        echo "{\"success\": \"true\", \"username\": $username}";
    } else {
        echo "{\"success\": \"false\"}";
    }
} catch (Exception $e) {
    error(500, $e);
}