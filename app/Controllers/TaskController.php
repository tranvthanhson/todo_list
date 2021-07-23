<?php

namespace App\Controllers;

use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Index
     *
     * @return view
     */
    public function index()
    {
        return view('task/index');
    }

    /**
     * Table
     *
     * @return response
     */
    public function table()
    {
        $tasks = Task::all();

        echo $this->response('', '', $tasks);
    }

    /**
     * Store
     *
     * @return response
     */
    public function store()
    {
        $data = [
            'name'       => $_POST['name'],
            'start_date' => $_POST['start_date'],
            'end_date'   => $_POST['end_date'],
            'status'     => $_POST['status'],
        ];
        if ($data['name'] == '') {
            echo $this->response('', 'Name is not correct');
            return;
        }
        if ($data['start_date'] == '') {
            echo $this->response('', 'Start date is not correct');
            return;
        }
        if ($data['end_date'] == '') {
            echo $this->response('', 'End date is not correct');
            return;
        }

        Task::insert($data);
        echo $this->response('Create successfully');
    }

    /**
     * Destroy
     *
     * @return response
     */
    public function destroy()
    {
        Task::delete($_POST['id']);

        echo $this->response('Delete successfully');
    }

    /**
     * Update
     *
     * @return response
     */
    public function update()
    {
        $data = [
            'name'       => $_POST['name'],
            'start_date' => $_POST['start_date'],
            'end_date'   => $_POST['end_date'],
            'status'     => $_POST['status'],
        ];
        if ($data['name'] == '') {
            echo $this->response('', 'Name is not correct');
            return;
        }
        if ($data['start_date'] == '') {
            echo $this->response('', 'Start date is not correct');
            return;
        }
        if ($data['end_date'] == '') {
            echo $this->response('', 'End date is not correct');
            return;
        }
        Task::updateById($data, $_POST['id']);

        echo $this->response('Update successfully');
    }
}
