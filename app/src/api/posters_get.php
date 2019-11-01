<?php
include('env.php');
$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_DB);
if (mysqli_connect_errno()) {
    http_response_code(500);
    header("Content-Type: text/json");
    echo(json_encode(array('error' => 'unable to connect to database')));
    exit();
}
header("Content-Type: text/json");
$result = mysqli_query($con, "SELECT * FROM posters");
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo(json_encode($rows));
