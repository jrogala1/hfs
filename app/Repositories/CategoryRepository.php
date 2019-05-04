<?php

namespace App\Repositories;

use App\Models\Category;

use DB;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getCategoryById($id)
    {
        return DB::table('categories')->where('name', '=', $id)->value('id');
    }
}