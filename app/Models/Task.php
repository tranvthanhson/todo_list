<?php

namespace App\Models;

class Task extends BaseModel
{
    static $table = 'tasks';

    const STATUS_TO_DO = 0;
    const STATUS_DOING = 1;
    const STATUS_DONE  = 2;
}
