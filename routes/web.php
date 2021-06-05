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

use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\Request;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::get('/','PostController@getIndex')->name('blog.index');
Route::get('post/{id}',[
    'uses'=>'PostController@getPost',
    'as'=>'blog.post'  // =(shortcut) name->('blog.post')
]);
Route::get('post/{id}/like',[
    'uses'=>'PostController@getLikePost',
    'as'=>'blog.post.like'  // =(shortcut) name->('blog.post')
]);
Route::get('about', 'PostController@about'
)->name('other.about');
Route::group(['prefix' => 'admin','middleware'=>['auth']], function () {
    Route::get('', [
          'uses'=>'PostController@getAdminIndex',
          'as'=>'admin.index',
       
    ]
    );
    Route::get('create', [
        'uses'=>'PostController@getAdminCreate',
        'as'=>'admin.create'
    ]
    );
    Route::get('delete/{id}', [
        'uses'=>'PostController@getAdminDelete',
        'as'=>'admin.delete'
    ]);
    Route::get('edit/{id}', [
        'uses'=>'PostController@getAdminEdit',
        'as'=>'admin.edit'
    ]);
    Route::post('create', [
        'uses'=>'PostController@postAdminCreate',
        'as'=>'admin.create'
    ]);
    Route::post('edit', [
        'uses'=>'PostController@postAdminUpdate',
        'as'=>'admin.update'
    ]);

    Route::post('saveComment', [
        'uses'=>'CommentController@store',
        'as'=>'admin.saveComment'
    ]);

});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('login', [
    'uses'=>'SigninController@signin',
    'as'=>'auth.signin'
]);
Route::get('password/reset/{token}',
['uses'=>'Auth\ResetPasswordController@showResetForm',
 'as'=>'password.reset.token'
]);
Route::get('password/reset', 
'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');

Route::resource('messages', 'MessageController');




    

