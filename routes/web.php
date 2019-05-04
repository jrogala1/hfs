<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
    'as' => '',
    'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);

/**
 *
 *  To be added in future versions of app.
 *
Route::post('password/email', [
    'as' => 'password.email',
    'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
    'as' => 'password.request',
    'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
    'as' => 'password.update',
    'uses' => 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
    'as' => 'password.reset',
    'uses' => 'Auth\ResetPasswordController@showResetForm'
]);**/


Route::get('register', [
    'as' => 'register',
    'uses' => 'Auth\RegisterController@index'
]);

Route::post('register', [
    'as' => '',
    'uses' => 'Auth\RegisterController@register'
]);

Route::get('/', function () {
    return view('index');
})->name('startpage');

/*
Route::get('/register', 'Auth\RegisterController@index')->name('register');
Route::post('register', 'Auth\RegisterController@store');*/

//Route::get('/login', 'Auth\LoginController@index');
//Route::post('login', 'Auth\LoginController@login');



//Route::get('/auth/admin/panel', 'Auth\Admin\AdminController@showAdminPanel')->name('admin');


//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/storage/{id}','Util\ResourcesController@displayFile');

Route::get('/about', function () {
    return view('contact');
});

Route::get('/storage/{folder}/{id}','Util\ResourcesController@displayFile');



Route::get('/articles/show/{id}', 'ArticleController@show');

Route::get('/articles/action/edit/{id}', 'ArticleController@showEditForm');

Route::post('/articles/action/edit/{id}', 'ArticleController@edit')->name('editArticle');

Route::get('/articles/action/remove/{id}', 'ArticleController@remove')->name('deleteArticle');

Route::get('/articles/action/create', 'ArticleController@showCreateForm')->name('article_createform');

Route::post('/articles/action/create', 'ArticleController@create')->name('article_create');

Route::get('/articles/list', 'ArticleController@list')->name('browse');

Route::get('/articles', 'ArticleController@index')->name('topArticles');


