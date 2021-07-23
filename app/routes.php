<?php

$router->get("", "TaskController@index");
$router->get("tasks/table", "TaskController@table");
$router->post("tasks/store", "TaskController@store");
$router->post("tasks/destroy", "TaskController@destroy");
$router->get("tasks/show", "TaskController@show");
$router->post("tasks/update", "TaskController@update");
