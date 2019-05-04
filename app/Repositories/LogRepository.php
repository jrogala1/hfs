<?php

namespace App\Repositories;

use App\Models\Logs;

use DB;

class LogRepository extends BaseRepository
{
    public function __construct(Logs $model)
    {
        $this->model = $model;
    }
}