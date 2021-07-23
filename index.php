<?php

ob_start();

require 'vendor/autoload.php';
require 'core/bootstrap.php';

use Core\Router;
use Core\Request;

Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());
