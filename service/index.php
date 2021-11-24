<?php
include_once '../core/init.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$endpoint = new Endpoint(array_slice($uri, array_search("service", $uri) + 1));
$method = $_SERVER['REQUEST_METHOD'];

$data = $_REQUEST;
$files = $_FILES['file'] ?? [];

Router::parse($endpoint, $method, $data, $files);
exit(Router::route());