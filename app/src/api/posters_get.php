<?php
require_once 'http_error.php';
require_once '../db-auth/db_inc.php';
header("Content-Type: text/json");

$res = $pdo->query('SELECT * FROM posters;');
if ($res) {
    echo(json_encode($res->fetchAll()));
} else {
    error(500, '{"success": false, "message": "unable to execute query"}');
}
