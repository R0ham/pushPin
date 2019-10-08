<?php

require_once "api_def.php";
require_once "http_error.php";

$method = ($_SERVER["REQUEST_METHOD"]);

$uri = substr($_SERVER["REQUEST_URI"], 5);

$allowed = $api[$uri];

if ($allowed) {

    $resolved = $api[$uri][$method];
    if ($resolved) {
        require_once $resolved;
    } else {
        error(405, "Method " . $method . " not allowed");
    }
} else {
    error(404, "REST endpoint not found");
}