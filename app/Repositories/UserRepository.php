<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUserId($data)
    {
        //DB::table('users')->select('id')->where('email', '=', $data)->get();
        return $this->model->where('email', '=', $data)->value('id');
    }

}