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

Route::group(['prefix' => '', 'middleware' => ['ability:admin,create-users']], function(){
	// Articles routes
	Route::get('/article', 'ArticleController@index');
	Route::post('/article', 'ArticleController@store');
Route::get('/article/{id}', 'ArticleController@show');
	Route::put('/article/{id}', 'ArticleController@update');
	Route::delete('/article/{id}', 'ArticleController@destroy');

	// Testimonies routes


	Route::get('/testimony', 'TestimonyController@index');
	Route::get('/testimony/{id}', 'TestimonyController@show');
	Route::post('/testimony', 'TestimonyController@store');
	Route::put('/testimony/{id}', 'TestimonyController@update');
	Route::delete('/testimony/{id}', 'TestimonyController@destroy');


    Route::get('approved', 'TestimonyController@showapproved');
    Route::get('disapproved', 'TestimonyController@showDisapproved');

    Route::get('category', 'CategoryController@index');
    Route::get('category/{id}', 'CategoryController@show');
    Route::post('category', 'CategoryController@store');
   Route::put('category/{id}', 'CategoryController@update');
    Route::delete('category/{id}', 'CategoryController@destroy');

     Route::get('stat', 'JwtAuthenticateController@total');
    Route::get('profile', 'JwtAuthenticateController@userProfile');
});

Route::get('/', function () {
    return view('welcome');
});
// Route::resource('category', 'CategoryController');


Route::group(['prefix' => 'admin', 'middleware' => ['ability:admin,assign-admin']], function()
{
	Route::get('roles/all', 'RolesController@getRoles');
	Route::get('roles', 'RolesController@paginatedRoles');
	Route::post('roles', 'RolesController@store');
	Route::put('roles', 'RolesController@update');
	Route::delete('roles/{id}', 'RolesController@destroy');
	// permissions
	Route::post('permissions', 'PermissionsController@store');
	Route::put('permissions', 'PermissionsController@update');
	Route::get('permissions/all', 'PermissionsController@getPermissions');
	Route::get('permissions', 'PermissionsController@paginatedPermissions');
	Route::delete('permissions/{id}', 'PermissionsController@destroy');

// just here
	Route::get('users', 'JwtAuthenticateController@index');
	Route::post('role', 'JwtAuthenticateController@createRole');
	Route::post('permission', 'JwtAuthenticateController@createPermission');
	Route::post('assign-role', 'JwtAuthenticateController@assignRole');
	Route::post('attach-permission', 'JwtAuthenticateController@attachPermission');
	Route::post('check', 'JwtAuthenticateController@checkRoles');
	Route::post('check-permissions', 'JwtAuthenticateController@checkPermissions');
});


// Route::get('profile/{id}', 'JwtAuthenticateController@userProfile');

Route::post('/authenticate', 'JwtAuthenticateController@authenticate');
Route::post('/register','JwtAuthenticateController@register');
Route::post('/mail', 'JwtAuthenticateController@mail');
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
