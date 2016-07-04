<?php 
require ('vendor/autoload.php');
require ('functions.php');

use Symfony\Component\HttpFoundation\JsonResponse;

// $host = '91.121.183.25';
$host = '';
$port = ;

$data = getUrtServerStatus($host, $port, 15);
$response = new JsonResponse();
$response->setData($data);
@$response->send();
