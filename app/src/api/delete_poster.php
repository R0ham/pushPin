<?php

session_start();

require_once 'http_error.php';
require_once '../db-auth/db_inc.php';
require_once '../db-auth/account_class.php';

$account = new Account();

try {
    if ($account->sessionLogin()) {
        $uid = $account->getUserID();
    } else {
        error(403, 'Not logged in');
    }
} catch (Exception $e) {
    error(500, $e->getMessage());
}

if (!isset($_REQUEST['pid'])) {
    error(400, 'Missing poster id (pid) parameter');
}
try {
    $checkPosterAccQuery = 'SELECT account_id FROM posters WHERE poster_id = :pid;';
    $pq = $pdo->prepare($checkPosterAccQuery);
    $pq->execute(array(':pid' => $_REQUEST['pid']));
} catch (Throwable $ex) {
    error(500, $ex->getMessage());
}
$poster = $pq->fetchAll(PDO::FETCH_ASSOC);
if (count($poster) !== 1)
    error(400, 'Unknown poster id');
$poster = $poster[0];
if ($poster['account_id'] != $uid) {
    error(403, 'Unauthorized to edit poster)');
}
try {
    $pq = $pdo->prepare('DELETE FROM posters WHERE poster_id = :pid');
    if (!$pq->execute(array(':pid' => $_REQUEST['pid']))) {
        error(500, 'Unable to delete poster');
    }
} catch (Throwable $ex) {
    error(500, $ex->getMessage());
}

header("Content-Type: text/json");
echo '{"success": true}';
