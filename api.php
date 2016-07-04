<?php 
require ('vendor/autoload.php');
require ('functions.php');

use Symfony\Component\HttpFoundation\JsonResponse;

// $host = '91.121.183.25';
$host = '45.119.120.2';
$port = 27960;

$data = getUrtServerStatus($host, $port, 15);
$response = new JsonResponse();
$response->setData($data);
@$response->send();
