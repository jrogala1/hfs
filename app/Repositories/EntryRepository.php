<?php

namespace App\Repositories;

use App\Models\Entry;



use DB;


class EntryRepository extends BaseRepository
{
    public function __construct(Entry $model)
    {
        $this->model = $model;
    }

    public function getAllArticles()
    {
        return $this->model->orderBy('created_at', 'desc')->simplePaginate(12);
    }

    public function exists($id)
    {
        return $this->model->where('id', '=', $id)->exists();
    }

    public function getTopArticles()
    {
        return $this->model->orderBy('votes_up', 'desc')->take(9)->get();
    }

    public function getCategoryName($id)
    {
        return $this->model->where('id', '=', $id)->value('name')->get();
    }

    public function getRandomArticle($article_id)
    {
        return $this->model->select('id')->where('id', '!=', $article_id)->orderBy(DB::raw('RAND()'))->take(1)->get();
    }

    public function getArticlesBasedOnCategory($id, $article_id)
    {
        return $this->model->where('category_id', '=', $id)->where('id', '!=', $article_id)->orderBy(DB::raw('RAND()'))->take(2)->get();
    }

    public function getAmountOfArticlesCreatedByUser($id)
    {
        return $this->model->where('user_id', '=', $id)->count();
    }

    public function getFavouriteCategory($id)
    {
        /** return DB::raw(
            'SELECT categories.name, categories.name ,COUNT(*) AS Liczba_artykulow
                    FROM entries 
                    INNER JOIN users
                    ON entries.user_id = users.id
                    INNER JOIN categories
                    ON categories.id = entries.category_id
                    WHERE users.id = ' . $id . '
                    GROUP BY category_id 
                    LIMIT 1')->getValue();
         */

            return $this->model->select(DB::raw('categories.id, categories.name, COUNT(*) AS Liczba_artykulow'))
                                ->join('users', 'users.id', '=', 'entries.user_id')
                                ->join('categories', 'categories.id', '=', 'entries.category_id')
                                ->where('users.id', '=', $id)
                                ->groupBy(DB::raw('categories.id, categories.name'))
                                ->orderBy('Liczba_artykulow', 'desc')
                                ->limit(1)
                                ->get();
    }

    public function removeArticle($id)
    {
        return $this->model->where('id', '=', $id)->delete();
    }

    public function getCreatorsId($articleid)
    {
        return $this->model->select('user_id')->where('id', '=', $articleid)->value('user_id');
    }
}