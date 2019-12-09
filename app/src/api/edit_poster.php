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

$checkPosterAccQuery = 'SELECT account_id, title, description, event_date, takedown_date FROM posters WHERE poster_id = :pid;';
$pq = $pdo->prepare($checkPosterAccQuery);
$pq->execute(array(':pid' => $_REQUEST['pid']));
$poster = $pq->fetchAll(PDO::FETCH_ASSOC);
if (count($poster) !== 1)
    error(400, 'Unknown poster id');
$poster = $poster[0];
if ($poster['account_id'] != $uid) {
    error(403, 'Unauthorized to edit poster');
}

$title = isset($_REQUEST['title']) ? $_REQUEST['title'] : $poster['title'];
$des =       isset($_REQUEST['description']) ? $_REQUEST['description'] : $poster['description'];
$eventDate = isset($_REQUEST['eventDate']) ? $_REQUEST['eventDate'] : $poster['event_date'];
$takedown =  isset($_REQUEST['takedown']) ? $_REQUEST['takedown'] : $poster['takedown_date'];

$pq = $pdo->prepare('UPDATE posters SET title = :title, description = :des, event_date = :eventDate, takedown_date = :takedown WHERE poster_id = :pid');
if (!$pq->execute(array(':pid' => $_REQUEST['pid'], ':title' => $title, ':des' => $des, ':eventDate' => $eventDate, ':takedown' => $takedown))) {
    error(500, 'Unable to update data');
}

header("Content-Type: text/json");
echo '{"success": true}';
