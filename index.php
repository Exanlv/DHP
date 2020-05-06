<?php
require(__DIR__ . '/vendor/autoload.php');

use DHP\Client;

new Client(trim(file_get_contents('.token')));