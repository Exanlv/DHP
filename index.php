<?php
require(__DIR__ . '/vendor/autoload.php');

use DHP\Client;

$token = trim(file_get_contents('.token'));

new Client($token);