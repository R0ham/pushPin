<?php
require_once 'http_error.php';
require_once '../db-auth/db_inc.php';
header("Content-Type: text/json");

if (isset($_GET['user'])) {
    $query = 'SELECT posters.*, accounts.account_name FROM posters INNER JOIN accounts ON posters.account_id = accounts.account_id WHERE account_name = :acc_name;';
    $pre = $pdo->prepare($query);
    $res = $pre->execute(array(':acc_name' => $_GET['user']));
    if ($res) {
        $obj = $pre->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    $res = $pdo->query('SELECT posters.*, accounts.account_name FROM posters INNER JOIN accounts ON posters.account_id = accounts.account_id WHERE posters.takedown_date >= CURDATE() ORDER BY posters.event_date;');
    if ($res) {
        $obj = $res->fetchAll(PDO::FETCH_ASSOC);
        $res = true;
    }
    else {
        $res = false;
    }
}

if ($res) {
    echo(json_encode($obj));
} else {
    error(500, 'unable to execute query');
}