<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginViewController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistrationViewController;
use App\Http\Controllers\UserRegistrationController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('register', RegistrationViewController::class)->name('register');
    Route::get('login', LoginViewController::class)->name('login');

    Route::post('/auth/registration', UserRegistrationController::class);
    Route::post('/auth/login', LoginController::class);

});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/auth/logout', LogoutController::class)->name('logout');
    Route::get('/home', HomeController::class)->name('home');
});
