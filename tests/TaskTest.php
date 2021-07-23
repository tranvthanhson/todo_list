<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public $http;

    /**
     * Set up
     *
     * @return void
     */
    public function setup()
    {
        $this->http = new \GuzzleHttp\Client(['base_uri' => 'http://f3c1e4f4eb9e.ngrok.io/']);
    }

    /**
     * Test get task
     *
     * @return void
     */
    public function testGetTask()
    {
        $response = $this->http->request('GET', '/tasks/table');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test store task
     *
     * @return void
     */
    public function testStoreTask()
    {
        $params =  [
            'form_params' => [
                'name' => 'Test task',
                'start_date' => '2021-07-23 05:00:00',
                'end_date' => '2021-07-23 15:00:00',
                'status' => 0,
            ]
        ];
        $response = $this->http->request('POST', '/tasks/store', $params);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
