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

Route::get('/', function () {
    return view('welcome');
});

//41,10
///ddddddddd

Route::group(['namespace'=>'Admin' , 'prefix'=>'admin'] , function (){
    $this->get('panel' , 'PanelController@index');
    $this->resource('articles' , 'ArticleController');
    $this->resource('courses' , 'CourseController');
    $this->resource('episodes' , 'EpisodeController');
    $this->post('/panel/upload-image ' , 'PanelController@uploadImageSubject');
    $this->resource('roles' , 'RoleController');
    $this->resource('permissions' , 'PermissionController');

    $this->group([] , function (){
        $this->resource('users' , 'UserController');
    });
//57-10

});