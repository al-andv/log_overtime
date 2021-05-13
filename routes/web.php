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

Route::get('login','Auth\LoginController@getLogin');
Route::get('','Auth\LoginController@getLogin');
Route::get('page/login','Auth\LoginController@getLogin');
Route::post('page/login','Auth\LoginController@postLogin');
Route::get('page/logout', 'Auth\LoginController@getLogout');

Route::get('forgot-password', 'Auth\ForgotPasswordController@index')
    ->middleware('guest')->name('password.request');
Route::post('forgot-password', 'Auth\ForgotPasswordController@sendMail')
    ->middleware('guest')->name('password.email');
Route::get('reset-password/{token}', 'Auth\ResetPasswordController@getReset')
    ->middleware('guest')->name('password.reset');
Route::post('reset-password/{token}', 'Auth\ResetPasswordController@postReset')
    ->middleware('guest')->name('password.update');

Route::group(['prefix'=>'page','middleware'=>'login'], function() {
    Route::get('home', 'PageController@index');
    Route::get('contact', 'PageController@getContact');
    Route::post('contact', 'PageController@postContact');
    Route::post('search', 'PageController@postSearch');
    Route::get('notification/{id}', 'PageController@getNotication');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('', 'PageController@getProfile');
        Route::get('edit/{id}', 'PageController@getEdit');
        Route::post('edit/{id}', 'PageController@postEdit');
    });

    Route::group(['prefix' => 'overtime'], function () {
        Route::get('/{id}', 'PageController@getOvertime');
        Route::get('/{id}/month={i}', 'PageController@getMonth');
        Route::get('add/{id}', 'PageController@getAddOvertime');
        Route::post('add/{id}', 'PageController@postAddOvertime');
        Route::get('edit/{id}', 'PageController@getEditOvertime');
        Route::post('edit/{id}', 'PageController@postEditOvertime');
        Route::get('delete/{id}', 'PageController@getDeleteOvertime');
    });

    Route::group(['prefix' => 'attendence'], function () {
        Route::get('/{id}', 'PageController@getOfftime');
        Route::get('/{id}/month={i}', 'PageController@showMonthAttendence');
        Route::get('add/{id}', 'PageController@getAddOfftime');
        Route::post('add/{id}', 'PageController@postAddOfftime');
    });
});

Route::group(['prefix'=>'admin','middleware'=>'login'], function() {

    Route::post('search', 'AdminController@postSearch');
    Route::get('details/{id}', 'AdminController@getDetails');
    Route::get('notification/{id}', 'AdminController@getNotification');

    Route::group(['prefix' => 'home','middleware'=>'checkTime'], function () {
        Route::get('', 'AdminController@index');
        Route::post('list-to-do/add', 'AdminController@postListAdd');
        Route::get('list-to-do/delete/{id}', 'AdminController@getListDelete');
        Route::get('export-ot/{id}', 'AdminController@getExportOvertimeOneUser');
    });

    Route::group(['prefix' => 'user_manage', 'middleware'=>'checkTime'], function () {
        Route::get('list', 'UserController@index');
        Route::get('add', 'UserController@getAdd');
        Route::post('add', 'UserController@postAdd');
        Route::get('edit/{id}', 'UserController@getEdit');
        Route::post('edit/{id}', 'UserController@postEdit');
        Route::get('delete/{id}', 'UserController@getDelete');
        Route::get('export', 'UserController@getExport');
    });

    Route::group(['prefix' => 'attendence', 'middleware'=>'checkTime'], function () {
        Route::get('list', 'AttendenceController@index');
        Route::get('list/month={month}', 'AttendenceController@showMonth');
        Route::get('add', 'AttendenceController@getAdd');
        Route::post('add', 'AttendenceController@postAdd');
        Route::get('edit/{id}', 'AttendenceController@getEdit');
        Route::post('edit/{id}', 'AttendenceController@postEdit');
        Route::get('delete/{id}', 'AttendenceController@getDelete');
        Route::get('export', 'AttendenceController@getExport');
    });

    Route::group(['prefix' => 'overtime', 'middleware'=>'checkTime'], function () {
        Route::get('list', 'OvertimeController@index');
        Route::get('list/month={month}', 'OvertimeController@showMonth');
        Route::get('add', 'OvertimeController@getAdd');
        Route::post('add', 'OvertimeController@postAdd');
        Route::get('edit/{id}', 'OvertimeController@getEdit');
        Route::post('edit/{id}', 'OvertimeController@postEdit');
        Route::get('delete/{id}', 'OvertimeController@getDelete');
        Route::get('export', 'OvertimeController@getExport');
        Route::post('import', 'OvertimeController@postImport');
    });
});



