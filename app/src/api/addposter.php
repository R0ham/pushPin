<?php

require_once 'http_error.php';
require_once '../db-auth/db_inc.php';
require_once '../db-auth/account_class.php';


$targetDir = "uploaded_posters/";
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}


function doUpload($fname)
{
    $targetDir = "uploaded_posters/";
    $targetFile = $targetDir . $fname;
    $check = getimagesize($_FILES["poster"]["tmp_name"]);
    if ($check === false) {
        return 1;
    }
    if ($_FILES["poster"]["size"] > 10000000) {
        return 2;
    }
    move_uploaded_file($_FILES["poster"]["tmp_name"], $targetFile);
    return $fname;

}

$account = new Account();
header("Content-Type: text/json");
try {
    if ($account->sessionLogin()) {
        $username = $account->getUserName();
    } else {
        error(403, 'Not authenticated');
        die();
    }
} catch (Exception $e) {
    error(500, $e);
    die();
}

$unique = false;
while (!$unique) {
    $fname_base = generate_string($permitted_chars, 32);
    $imageFileType = strtolower(pathinfo($_FILES["poster"]["name"],PATHINFO_EXTENSION));
    $fname = $targetDir . $fname_base . '.' . $imageFileType;
    $unique = !file_exists($fname);
}

$res = doUpload($fname);

if ($res === 1) {
    error(400, 'Upload was not an image');
} else if ($res === 2) {
    error(400, 'Upload was too large');
} else {
    $query = 'INSERT INTO posters (account_id, title, image_file, takedown, event_date) VALUES (:accountID, :title, :imageFile, :takedown, :eventDate);';
    $vals = array(':accountID' => $account->getUserID(), ':title' => $_POST['posterName'],
        ':imageFile' => $fname_base, ':takedown' => $_POST['takedown-date'], ':eventDate' => $_POST['event-date']);

    $pre = $pdo->prepare($query);
    $pre->execute($vals);
    header("Content-Type: text/json");
    echo '{"success": "true"}';
}
