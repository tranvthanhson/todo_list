<?php

return [
    'database' => [
        'name' => 'todolist',
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => 'root',
        'connection' =>  'mysql',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
