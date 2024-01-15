<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\LandlordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProvinceCellDataController;
use App\Http\Controllers\TenantController;

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
Route::get('/', [HouseController::class, 'showLatestHouses']);

Route::get('/login', AuthController::class . '@showLoginForm')->name('login');
Route::post('/login', AuthController::class . '@login')->name('login');
Route::post('/logout', AuthController::class . '@logout')->name('logout');
Route::get('/signup', AuthController::class . '@showSignUpForm')->name('signup');
Route::post('/register', AuthController::class . '@register')->name('register');
Route::get('/about', AboutController::class . '@showAboutPage')->name('about');
Route::get('/properties', PropertiesController::class . '@showPropertiesList')->name('properties');
Route::get('/single-property/{id}', PropertiesController::class . '@showSingleProperty')->name('single-property');
Route::get('/contact', ContactController::class . '@showContactPage')->name('contact');
Route::get('/dashboard', DashboardController::class . '@index')->name('dashboard.index')->middleware('admin');
Route::get('/dashboard/tenants', [TenantController::class, 'getTenants'])->name('dashboard.tenants')->middleware('admin');
// Corrected route for landlords
Route::get('/dashboard/landlords', [LandlordController::class, 'getLandlords'])
    ->name('dashboard.landlords')
    ->middleware('admin.only');
Route::get('/dashboard/add-house', [HouseController::class, 'showAddHouseForm'])->middleware('admin')->name('dashboard.add-house');
Route::post('/dashboard/add-house', [HouseController::class, 'createHouse'])->middleware('admin')->name('dashboard.create-house');
Route::get('/dashboard/view-houses', [HouseController::class, 'showAllHouses'])->middleware('admin')->name('dashboard.view-houses');
// Route::get('/dashboard/all-houses', [HouseController::class, 'showAllHouses'])->middleware('admin')->name('dashboard.all-houses');
Route::delete('/dashboard/delete-house/{id}', [HouseController::class, 'deleteHouse'])->middleware('admin')->name('dashboard.delete-house');
Route::put('/dashboard/update-house/{id}', [HouseController::class, 'updateHouse'])->middleware('admin')->name('dashboard.update-house');
Route::put('/toggle-house/{id}', [HouseController::class, 'toggleHouse'])->middleware('admin')->name('dashboard.toggle-house');
Route::get('/properties', [HouseController::class, 'showAvailableHouse'])->name('properties');
Route::post('/search-properties', [HouseController::class, 'searchProperties'])->name('search.properties');

// Routes for profile
Route::get('/dashboard/profile', [ProfileController::class, 'showProfile'])->middleware('admin')->name('dashboard.profile');
Route::put('/dashboard/profile/update', [ProfileController::class, 'updateProfile'])->name('dashboard.profile.update');
Route::put('/dashboard/profile/update-password', [ProfileController::class, 'updatePassword'])->name('dashboard.profile.updatePassword');

Route::get('/user-profile', [ProfileController::class, 'showUserProfile'])->name('user-profile');
Route::put('/user-profile/update', [ProfileController::class, 'updateUserProfile'])->name('user-profile.update');
Route::put('/user-profile/update-password', [ProfileController::class, 'updateUserPassword'])->name('user-profile.updatePassword');
//Api for getting all provinceData
Route::get('/get-province-cell-data', [ProvinceCellDataController::class, 'getProvinceCellData']);