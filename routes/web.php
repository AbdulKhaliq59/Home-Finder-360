<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PropertiesController;
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
Route::get('/signup', AuthController::class . '@showSignUpForm')->name('signup');
Route::get('/about', AboutController::class . '@showAboutPage')->name('about');
Route::get('/properties', PropertiesController::class . '@showPropertiesList')->name('properties');
Route::get('/single-property', PropertiesController::class . '@showSingleProperty')->name('single-property');
Route::get('/contact', ContactController::class . '@showContactPage')->name('contact');
