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

Route::group(['prefix' => '/', 'user.', 'namespace' => 'User'], function () {
    Auth::routes();

    Route::get('/', function () {
        if (Auth::check()) {
            return redirect()->route('home');
        } else {
            return view('user.auth.login');
        }
    });

    Route::get('slack/login', 'Auth\AuthenticateController@callSlackApi');
    Route::get('callback', 'Auth\AuthenticateController@loginBySlackUserInfo');

    Route::post('/register', 'Auth\RegisterController@register');
    Route::get('/register/{query}', 'Auth\RegisterController@showRegistrationForm');

    Route::get('home', 'UserController@index')->name('home');

    Route::resource('report', DailyReportController::class);

    Route::get('question/{id}/mypage', ['as' => 'question.mypage', 'uses' => 'QuestionController@myPage']);
    Route::post('question/confirm', ['as' => 'question.confirm', 'uses' => 'QuestionController@confirm']);
    Route::post('question/{id}/confirm', ['as' => 'confirm.update', 'uses' => 'QuestionController@confirm']);
    Route::post('question/{id}/comment', ['as' => 'question.comment', 'uses' => 'QuestionController@storeComment']);
    Route::resource('question', QuestionController::class);

    Route::get('attendance/absence', 'AttendanceController@absence')->name('attendance.absence');
    Route::get('attendance/mypage', 'AttendanceController@mypage')->name('attendance.mypage');
    Route::get('attendance/modify', 'AttendanceController@modify')->name('attendance.modify');
    Route::post('attendance/absenceRegistration', 'AttendanceController@absenceRegistration')->name('attendance.absenceRegistration');
    Route::post('attendance/correctionRegistration', 'AttendanceController@correctionRegistration')->name('attendance.correctionRegistration');
    Route::resource('attendance', AttendanceController::class);

});


Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'namespace' => 'Admin'], function() {
    Auth::routes();

    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::get('report', function () {
        abort(404);
    });
    Route::get('question', function () {
        abort(404);
    });
    Route::get('user', function () {
        abort(404);
    });
    Route::get('adminuser', function () {
        abort(404);
    });
    Route::get('contact', function () {
        abort(404);
    });

    Route::post('password/email',['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset',['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ResetPasswordController@reset']);
    Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);

    Route::post('/register', ['as' => 'register', 'uses' => 'Auth\AdminRegisterController@adminRegister']);
    Route::get('/register/', 'Auth\AdminRegisterController@showAdminRegistrationForm');

});

