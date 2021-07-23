<?php

ob_start();

require 'vendor/autoload.php';
require 'core/bootstrap.php';

use Core\{Router, Request};

Router::load('app/routes.php')
    ->direct(Request::uri(), Request::method());
