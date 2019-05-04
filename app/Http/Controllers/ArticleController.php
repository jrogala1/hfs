<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Util\ResourcesController;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\UserRepository;
use http\Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;

use App\Models\Entry;

use App\Repositories\EntryRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use MongoDB\Driver\Exception\ServerException;

class ArticleController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $top = $this->generateTopArticles();

        return view('articles.index', ["top" => $top]);
    }

    public function showCreateForm(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->getAll();

        return view('articles.create', ["categories" => $categories]);
    }

    public function list(EntryRepository $entryRepository)
    {
        $articles = $entryRepository->getAllArticles();

        return view('articles.list' , ["articles" => $articles,
                                                "title" => "test"]);
    }

    public function show(EntryRepository $entry, $id)
    {
        if($entry->exists($id)) {

            $article = $entry->find($id); // get single article to show
        //dd($article);
            $recommended = $entry->getArticlesBasedOnCategory($article->category_id, $article->id); // get two different articles based on category

            $user = ['amount' => $entry->getAmountOfArticlesCreatedByUser($article->user_id), 'category' => $entry->getFavouriteCategory($article->user_id)]; // get information about user

            $randomArticle = $entry->getRandomArticle($id);

            return view('articles.article', ["article" => $article,
                                                    "recommended" => $recommended,
                                                    "user_prop" => $user,
                                                    "title" => "Artykuł",
                                                    "randomArticle" => $randomArticle]);
        } else
        return view('articles.error', ["id" => $id,
            "title" => "Nie znaleziono artykułu"]);
    }

    public function create(Request $request, CategoryRepository $categoryRepository, ResourcesController $resourcesController)
    {
            $this->validateArticle($request);


            $category_id = $categoryRepository->getCategoryById($request->input('category'));

            $userId = $request->user()->id;

            $a_filename = $request->input('title') . '_' . $request->user()->id . uniqid() . '_a_' . date("dmyhisa");
            $i_filename = $request->user()->id . uniqid() . '_i_' . date("dmyhisa");

            $extension = $request->file('art_file')->getClientOriginalExtension();

            $request->file('art_file')->storeAs('articles', $a_filename . '.' . $extension);
            $a_filename = $a_filename . '.' . $extension;

            $extension = $request->file('img')->getClientOriginalExtension();
            $request->file('img')->storeAs('images', $i_filename . '.' . $extension);
            $i_filename = $i_filename . '.' . $extension;

            $article = new Entry();
            $article->title = $request->input('title');
            $article->description = $request->input('description');
            $article->user_id = $userId;
            $article->category_id = $category_id;
            $article->article_file = $resourcesController->getPathToFile('articles', $a_filename);
            $article->image_file = $resourcesController->getPathToFile('images', $i_filename);
            $article->save();

            return redirect()->to('articles/show/' . $article->id);
    }

    private function generateTopArticles()
    {
        $article = new EntryRepository(new Entry());

        return $article->getTopArticles();
    }

    private function validateArticle(Request $request, $edit = false)
    {
        if(!$edit) {
            $attributes = [
                'title' => 'Tytuł',
                'description' => 'Opis',
                'category' => 'Kategoria',
                'art_file' => 'Plik ze ściągą',
                'img' => 'Obraz artykułu'
            ];

            $request->validate([
                'title' => 'required|string|min:10|max:150',
                'description' => 'required|string|min:30|max:700',
                'category' => 'required|string',
                'art_file' => 'required|mimes:doc,pdf,docx,txt|max:5120',
                'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ], [], $attributes);
        } else
        {
            $attributes = [
                'title' => 'Tytuł',
                'description' => 'Opis',
                'category' => 'Kategoria',
            ];

            $request->validate([
                'title' => 'required|string|min:10|max:150',
                'description' => 'required|string|min:30|max:700',
                'category' => 'required|string',
            ], [], $attributes);
        }
    }

    public function remove($id, EntryRepository $entryRepository)
    {
        if ($entryRepository->removeArticle($id) == 1)
        {
            return redirect()->to('articles/list');
        }
        else
        {
            dd('tbi');
        }

    }

    public function showEditForm($id, EntryRepository $entry)
    {
        if($entry->exists($id)) {

            $article = $entry->find($id); // get single article to show
            $categories = new CategoryRepository(new Category());

            return view('articles.edit', ["article" => $article,
                "categories" => $categories->getAll(),
                "title" => "Artykuł"]);
        } else
            return view('articles.error', ["id" => $id,
                "title" => "Nie znaleziono artykułu"]);
    }

    public function edit(Request $request, EntryRepository $entryRepository)
    {
        $id = $request->input('id');

        if($this->checkEditPrivilieges($entryRepository->getCreatorsId($id))) {
            $this->validateArticle($request, true);

            $categoryRepository = new CategoryRepository(new Category());
            $category_id = $categoryRepository->getCategoryById($request->input('category'));

            $userId = $request->user()->id;

            $entryRepository->update( ['title' => $request->input('title'),
                                        'description' => $request->input('description'),
                                        'user_id' => $userId,
                                        'category_id' => $category_id] , $id);
        }

        return redirect()->to('articles/show/' . $id);
    }

    private function checkEditPrivilieges($userId)
    {
        if($userId == Auth::user()->id) return true;
        else return false;
    }
}
