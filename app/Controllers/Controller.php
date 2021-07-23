<?php

namespace App\Controllers;

class Controller
{
    /**
     * Response
     *
     * @param string $message message
     * @param string $error   error
     * @param array  $data    data
     *
     * @return json
     */
    public function response($message = '', $error = '', $data = [])
    {
        return json_encode([
            'message' => $message,
            'error' => $error,
            'data' => $data,
        ]);
    }
}
