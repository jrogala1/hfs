<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;

    public function getAll($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($data, $id)
    {
        return $this->model->where("id",'=',$id)->update($data);
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findSingleValue($id, $value)
    {
        return $this->model->find($id)->value($value);
    }

}