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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){
    Route::group(['prefix' => 'dashboard'], function(){
        Route::get('/', 'User\DashboardController@index')->name('dashboard.index');
    });
    Route::group(['prefix' => 'profile'], function(){
        Route::get('/', 'ProfileController@index')->name('profile.index');
        Route::post('/', 'ProfileController@update')->name('profile.update');
    });
    Route::group(['prefix' => 'activity'], function(){
        Route::get('/', 'ActivityController@index')->name('activity.index');
    });
    Route::group(['prefix' => 'school'], function(){
        Route::get('/', 'SchoolController@index')->name('school.index');
        Route::get('/add', 'SchoolController@add')->name('school.add');
        Route::post('/save', 'SchoolController@save')->name('school.save');
        Route::get('/show', 'SchoolController@show')->name('school.show');
        Route::post('/update', 'SchoolController@update')->name('school.update');
    });
    Route::group(['prefix' => 'teacher'], function(){
        Route::get('/', 'TeacherController@index')->name('teacher.index');
        Route::post('/search', 'TeacherController@index')->name('teacher.search');
        Route::get('/add', 'TeacherController@add')->name('teacher.add');
        Route::get('/edit/{id}', 'TeacherController@edit')->name('teacher.edit');
        Route::get('/delete/{id}', 'TeacherController@delete')->name('teacher.delete');
        Route::post('/update', 'TeacherController@update')->name('teacher.update');
        Route::post('/save', 'TeacherController@save')->name('teacher.save');
        Route::post('/import', 'TeacherController@import')->name('teacher.import');
        Route::get('/add-admin', 'TeacherController@addAdmin')->name('teacher.admin.add');
        Route::post('/save-admin', 'TeacherController@saveAdmin')->name('teacher.admin.save');
        Route::get('/delete_admin/{id}', 'TeacherController@deleteAdmin')->name('teacher.admin.delete');
    });
});
