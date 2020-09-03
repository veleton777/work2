<?php

require_once '../vendor/autoload.php';

use App\Location;

$dotenv = Dotenv\Dotenv::createMutable('../');
$dotenv->load();

$clientId = $_ENV['GEO_IP_SID'];
$opt = 'mr';
$ipAddress = '91.109.129.61';
// $ipAddress = $_SERVER['REMOTE_ADDR'];


$location = new Location($clientId, $ipAddress, $opt);
$data = $location->getData();

foreach ($data as $title => $value) {
    echo $title . ': ' . $value . '<br>';
}

