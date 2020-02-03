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

// use Illuminate\Routing\Route;
// use Illuminate\Support\Facades\Auth;

Route::get('/', function () {    
    return view('welcome');
});


Auth::routes();

Route::group(['middleware' => 'isAdmin'], function(){
Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['prefix' => 'users'], function(){
Route::group(['middleware' => 'isAdmin'], function(){
    Route::get('', 'UserController@index')->name('user.index');
    Route::post('store', 'UserController@store')->name('user.store');
    Route::post('update/{user}', 'UserController@update')->name('user.update');
    Route::post('delete/{user}', 'UserController@destroy')->name('user.destroy');
});
    Route::get('show/{user}', 'UserController@show')->name('user.show');
});

Route::group(['prefix' => 'tasks'], function(){
    Route::post('smallupdate/{task}', 'TaskController@update')->name('task.smallupdate');
        Route::group(['middleware' => 'isAdmin'], function(){
            Route::post('update/{task}', 'TaskController@update')->name('task.update');
            Route::post('store', 'TaskController@store')->name('task.store');
            Route::get('edit/{task}', 'TaskController@edit')->name('task.edit');
            Route::get('', 'TaskController@index')->name('task.index');
            Route::get('create', 'TaskController@create')->name('task.create');
            Route::post('delete/{task}', 'TaskController@destroy')->name('task.destroy');
            
});
});


// Route::group(['prefix' => 'tasks'], function(){
//         Route::get('', 'TaskController@index')->name('usertasks.index');
//         Route::post('update/{task}', 'TaskController@update')->name('usertasks.update');
// });
