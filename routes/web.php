<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CorporateController;
use App\Http\Controllers\ProjectController;
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
    return redirect('/login');
});

Auth::routes(['register' => false]);

Route::resource('/dashboard', HomeController::class);

// Skill navigations
Route::get('/skills', [HomeController::class, 'skillView'])->name('list.skill');
Route::post('/skills/create', [HomeController::class, 'skillStore'])->name('store.skill');
Route::get('/skill-resource', [HomeController::class, 'skillResourceAjax'])->name('resource.skill');

// Corporates navigations
Route::resource('/corporates', CorporateController::class);
Route::get('/corporates/resources', [CorporateController::class, 'corporateResourceAjax'])->name('corporates.resource');

// Users navigations
Route::resource('/users', UserController::class);
Route::post('/users/download-pdf', [UserController::class, 'generatePDF'])->name('users.downloadpdf');
Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
Route::post('/profile/upload', [UserController::class, 'uploadProfile'])->name('profile.upload');

// Projects navigations
Route::resource('/projects', ProjectController::class);
