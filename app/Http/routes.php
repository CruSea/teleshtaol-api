<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Http\Request;
use App\Http\Requests;


Route::group(['prefix' => '', 'middleware' => ['ability:admin,create-users']], function()
{	
	// Articles routes
	Route::get('/article', 'ArticleController@index');
	Route::post('/article', 'ArticleController@store');
	Route::put('/article/{id}', 'ArticleController@update');
	Route::delete('/article/{id}', 'ArticleController@destroy');
	
	// Testimonies routes
	
	Route::get('/testimony', 'TestimonyController@index');
	Route::post('/testimony', 'TestimonyController@store');
	Route::put('/testimony', 'TestimonyController@update');
	Route::delete('/testimony', 'TestimonyController@destroy');

    Route::get('profile', 'JwtAuthenticateController@userProfile');
    Route::get('approved', 'TestimonyController@showapproved');
    Route::get('disapproved', 'TestimonyController@showDisapproved');

    Route::resource('category', 'CategoryController');

});

Route::get('/', function () {
    return view('welcome');
});

Route::post('role', 'JwtAuthenticateController@createRole');
Route::post('permission', 'JwtAuthenticateController@createPermission');
Route::post('assign-role', 'JwtAuthenticateController@assignRole');
Route::post('attach-permission', 'JwtAuthenticateController@attachPermission');
Route::post('check', 'JwtAuthenticateController@checkRoles');

Route::group(['prefix' => '', 'middleware' => ['ability:admin,create-users']], function()
{
    Route::get('no_users', 'JwtAuthenticateController@noUsers');

});

       
// Route::get('profile/{id}', 'JwtAuthenticateController@userProfile');

Route::post('/authenticate', 'JwtAuthenticateController@authenticate');
Route::post('/register','JwtAuthenticateController@register');

// resources  for Article
// Route::resource('/article', 'ArticleController');
// Route::get('/article', 'ArticleController');

// testimonies
// Route::resource('testimony', 'TestimonyController');
// Route::put('testimonies/{id}', 'TestimonyController@approveTestimony');

// Route::get('approved', 'TestimonyController@showapproved');
// Route::get('disapproved', 'TestimonyController@showDisapproved');

// testimony comment

// Route::resource('testimonycomment', 'TestimonyCommentController');
Route::get('testimonycomments', 'TestimonyCommentController@index');

Route::post('testimonycomment/{testimonyId}', 'TestimonyCommentController@store');

Route::get('testimonycomment/{testimonyId}', 'TestimonyCommentController@displayComments');

Route::put('testimonycomment/{testimony}/{id}' , 'TestimonyCommentController@edit');
// 
// catagories

// Route::post('category', 'CategoryController@createCategory');
//  Route::get('category', 'CategoryController@index');
  
  
// comment
// Route::post('comments/{$article_id}', ['uses' => 'ArticleCommentController@store', 'as' => 'comments.store']);
Route::post('comments/{articleId}', 'ArticleCommentController@store');
Route::get('comments/{articleId}', 'ArticleCommentController@displayComments');
Route::get('comments', 'ArticleCommentController@index');
Route::put('comments/{article}/{id}' , 'ArticleCommentController@edit');


// testimonies
// Route::get('testimonies', 'TestimonyController@index');
// route for articles
// Route::get('/articles', 'ArticleController@index');
// // show
// Route::get('article/{$id}', 'ArticleController@show');
// // store
// Route::post('/article', 'ArticleController@store');
// // delete article
// Route::delete('/article{$id}', 'ArticleController@destroy');
// Route::get('article/{id}/islikedbyme', 'API\PostController@isLikedByMe');
// Route::post('article/like', 'API\PostController@like');