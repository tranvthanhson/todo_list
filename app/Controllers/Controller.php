<?php

namespace App\Controllers;

class Controller
{
    public function response($message = '', $error = '', $data = [])
    {
        return json_encode([
            'message' => $message,
            'error' => $error,
            'data' => $data,
        ]);
    }
}
