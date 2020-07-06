<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'settings.php';
require 'spl_autoload_register.php';
require 'vendor/autoload.php';

/**
 * Define API endpoints
 * Links Uris with HttpVerb to Controller and Method
 * Ex:$Routes->add_route(Uri, HttpVerb, Controller, Method);
 */
$Routes = new App\Classes\Routes();
$Routes->add_route('cablemodems', 'GET', 'CableModemsController', 'get');
$Routes->add_route('models', 'GET', 'ModelsController', 'get');
$Routes->add_route('models', 'POST', 'ModelsController', 'add');
$Routes->check_request();