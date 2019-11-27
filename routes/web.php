<?php
use App\Http\Controllers\HomeController;

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
Route::group([
'middleware'=> 'auth'
], function(){
    Route::get('/logout', 'AuthController@logout');
    Route::get('/profile', 'ProfileController@index');
    Route::post('/profile', 'ProfileController@store');
    Route::post('/comment', 'ComentsController@store');

    
});

Route::group([
    'middleware'=> 'guest'
    ], function(){
        Route::get('/register', 'AuthController@registerForm')->name('register');
        Route::post('/register', 'AuthController@register');
        Route::get('/login', 'AuthController@loginForm')->name('login');
        Route::post('/login', 'AuthController@login');
        

        
    });
    




    Route::get('/', 'HomeController@inde')->name('index');
    Route::get('/post/{slug}', 'HomeController@show')->name('post.show');
    Route::get('/tag/{slug}', 'HomeController@tag')->name('tag.show');
    Route::get('/category/{slug}', 'HomeController@category')->name('category.show');
    Route::post('/subscribe', 'SubsController@subscribe');
    Route::get('/verify/{token}', 'SubsController@verify');




Route::group(['prefix'=>'admin','namespace'=>'Admin', 'middleware'=>'admin'], function()
{
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/tags', 'TagsController');
    Route::resource('/users', 'UsersController');
    Route::resource('/posts', 'PostsController');
    Route::get('/', 'DashboardController@index')->name('dashboard.show');
    Route::get('/comments', 'DashboardController@comments')->name('admin.comments');
    Route::get('/comments/toggle/{id}', 'DashboardController@toggle');
    Route::delete('/comments/{id}/destroy', 'DashboardController@destroy')->name('comments.destroy');
    Route::resource('/subscribers', 'SubscribersController');
    
});

