<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/gmail.setup.php';

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Gmail($client);

$user = 'me';
