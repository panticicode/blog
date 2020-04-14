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
Route::get('/test', function(){
	 return App\User :: find(1)->profile;

});
Route::get('/', 'FrontEndController@index')->name('index');
Route::get('/results', function(){
	$posts = \App\Models\Post::where('title', 'like',  '%' . request('query') . '%')->get();
	$post = 'Search results : ' . request('query');
	$categories = \App\Models\Category :: take(5)->get();
    $settings = \App\Models\Setting :: first();
	return view('results', [
		'posts' => $posts,
		'title' => $post,
		'categories' => $categories,
		'settings' => $settings,
		'query' => request('query')
	]);		
});
Route::get('/post/{slug}', 'FrontEndController@singlePost')->name('post.single');
Route::get('/category/{id}', 'FrontEndController@category')->name('category.single');
Route::get('/tag/{id}', 'FrontEndController@tag')->name('tag.single');
Auth::routes();
Route::group(['middleware' => 'auth', 'namespace' => 'Dashboard', 'prefix' => 'dashboard'], function(){

	Route::get('/home', 'HomeController@index')->name('home');
	/************POST ROUTES*************/
	Route::get('/post', [
		'uses' => 'PostsController@index',
		'as' => 'post.index'
	]);
	Route::get('/post/create', [
		'uses' => 'PostsController@create',
		'as' => 'post.create'
	]);
	Route::post('/post/store', [
		'uses' => 'PostsController@store',
		'as' => 'post.store'
	]);
	Route::get('/post/edit/{id}', [
		'uses' => 'PostsController@edit',
		'as' => 'post.edit'
	]);
	Route::post('/post/update/{id}', [
		'uses' => 'PostsController@update',
		'as' => 'post.update'
	]);
	Route::get('/post/destroy/{id}', [
		'uses' => 'PostsController@destroy',
		'as' => 'post.destroy'
	]);
	Route::get('/post/trashed', [
		'uses' => 'PostsController@trashed',
		'as' => 'post.trashed'
	]);
	Route::get('/post/restore/{id}', [
		'uses' => 'PostsController@restore',
		'as' => 'post.restore'
	]);
	Route::get('/post/deletedFromTrash/{id}', [
		'uses' => 'PostsController@deletedFromTrash',
		'as' => 'post.deletedFromTrash'
	]);
	//Route::resource('post', 'PostsController'); 
	/************POST ROUTES*************/
	/************CATEGORY ROUTES*************/
	Route::get('/category', [
		'uses' => 'CategoriesController@index',
		'as' => 'category.index'
	]);
	Route::get('/category/create', [
	'uses' => 'CategoriesController@create',
	'as' => 'category.create'
	]);
	Route::post('/category/store', [
		'uses' => 'CategoriesController@store',
		'as' => 'category.store'
	]);
	Route::get('/category/edit/{id}', [
		'uses' => 'CategoriesController@edit',
		'as' => 'category.edit'
	]);
	Route::post('/category/update/{id}', [
		'uses' => 'CategoriesController@update',
		'as' => 'category.update'
	]);
	Route::get('/category/destroy/{id}', [
		'uses' => 'CategoriesController@destroy',
		'as' => 'category.destroy'
	]);
	//Route::resource('category', 'CategoriesController'); 
	/************CATEGORY ROUTES*************/
	/************TAG ROUTES*************/
	Route::get('/tag', [
		'uses' => 'TagsController@index',
		'as' => 'tag.index'
	]);
	Route::get('/tag/create', [
	'uses' => 'TagsController@create',
	'as' => 'tag.create'
	]);
	Route::post('/tag/store', [
		'uses' => 'TagsController@store',
		'as' => 'tag.store'
	]);
	Route::get('/tag/edit/{id}', [
		'uses' => 'TagsController@edit',
		'as' => 'tag.edit'
	]);
	Route::post('/tag/update/{id}', [
		'uses' => 'TagsController@update',
		'as' => 'tag.update'
	]);
	Route::get('/tag/destroy/{id}', [
		'uses' => 'TagsController@destroy',
		'as' => 'tag.destroy'
	]);
	//Route::resource('tag', 'TagsController');
	/************TAG ROUTES*************/
	/************USER ROUTES*************/
	Route::get('/user', [
		'uses' => 'UsersController@index',
		'as' => 'user.index'
	]);
	Route::get('/user/create', [
		'uses' => 'UsersController@create',
		'as' => 'user.create'
	]);
	Route::post('/user/store', [
		'uses' => 'UsersController@store',
		'as' => 'user.store'
	]);
	Route::get('/user/admin/{id}', [
		'uses' => 'UsersController@admin',
		'as' => 'user.admin'
	]);
	Route::get('/user/destroy/{id}', [
		'uses' => 'UsersController@destroy',
		'as' => 'user.destroy'
	]);
	Route::get('/user/member/{id}', [
		'uses' => 'UsersController@member',
		'as' => 'user.member'
	]);
	//Route::resource('user', 'UsersController');
	/************USER ROUTES*************/
	/************PROFILE ROUTES*************/
	Route::get('/user/profile', [
		'uses' => 'ProfilesController@index',
		'as' => 'user.profile'
	]);
	Route::post('/user/profile/update', [
		'uses' => 'ProfilesController@update',
		'as' => 'user.profile.update'
	]);
	/************PROFILE ROUTES*************/
	/************SETTINGS ROUTES*************/
	Route::get('/setting', [
		'uses' => 'SettingsController@index',
		'as' => 'setting.index'
	]);
	Route::post('/setting/update', [
		'uses' => 'SettingsController@update',
		'as' => 'setting.update'
	]);
	/************SETTINGS ROUTES*************/
});







