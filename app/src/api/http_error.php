<?php

function error($http, $message) {
    http_response_code($http);
    header("Content-Type: text/json");
    echo(json_encode(array("error" => $message)));
    exit();
}
