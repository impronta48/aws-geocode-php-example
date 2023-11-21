<?php

require 'vendor/autoload.php'; // Include the AWS SDK for PHP
require 'config.php'; // Include the AWS credentials

use Aws\Credentials\Credentials;
use Aws\LocationService\LocationServiceClient;

// Set your AWS credentials
$credentials = new Credentials($accessKey, $secretKey);

// Create an instance of the LocationServiceClient
$locationService = new LocationServiceClient([
    'region' => $region, // e.g., us-west-2
    'credentials' => $credentials,
]);

// Specify the address you want to geocode
$address = 'Loc Ciocchini 18, 12060 Novello CN, Italy';

// Perform geocoding request
$result = $locationService->searchPlaceIndexForText([
    'IndexName' => $placeIndexName, // Specify the name of your place index
    'Text' => $address,
    "BiasPosition" => [
        -123.115898,
        49.295868
    ]
]);

// Extract coordinates from the result
$coordinates = $result['Results'][0]['Place']['Geometry']['Point'];

$latitudine = $coordinates[1];
$longitudine = $coordinates[0];
$livelloZoom = 15;

// Costruisci l'URL di OpenStreetMap
$openStreetMapUrl = "https://www.openstreetmap.org/?mlat=$latitudine&mlon=$longitudine#map=$livelloZoom";

// Stampare il link in HTML
//echo "<a href=\"$openStreetMapUrl\" target=\"_blank\">Visualizza su OpenStreetMap</a>\n\r";
echo $openStreetMapUrl . PHP_EOL;