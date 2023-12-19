<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', AuthController::class . '@showLoginForm')->name('login');
Route::post('/login', AuthController::class . '@login')->name('login');
Route::post('/logout', AuthController::class . '@logout')->name('logout');
Route::get('/signup', AuthController::class . '@showSignUpForm')->name('signup');
Route::post('/register', AuthController::class . '@register')->name('register');
Route::get('/about', AboutController::class . '@showAboutPage')->name('about');
Route::get('/properties', PropertiesController::class . '@showPropertiesList')->name('properties');
Route::get('/single-property', PropertiesController::class . '@showSingleProperty')->name('single-property');
Route::get('/contact', ContactController::class . '@showContactPage')->name('contact');
Route::get('/dashboard', DashboardController::class . '@index')->name('index')->middleware('admin');
