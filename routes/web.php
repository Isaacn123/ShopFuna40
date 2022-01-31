<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\subCategoryController;
use App\Http\Controllers\BussinessCategoryController;
use App\Http\Controllers\BussinessSubCategoryController;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
// use App\Http\Controllers\Controller;
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

Auth::routes();

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('home');

// Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);

Route::resource('category', CategoryController::class);
Route::resource('businesscategory', BussinessCategoryController::class);
Route::resource('business_sub-category',BussinessSubCategoryController::class);
Route::resource('sub-category', subCategoryController::class);
Route::resource('dash-b', DashboardController::class);

Route::get('emails', function(){
    Mail::to('nsambai72@gmail.com')->send(new WelcomeMail());
   return new WelcomeMail();
});


Route::get('fcm',[Controller::class, 'index']);
Route::get('send-notification',[Controller::class,'sendNotification']);
Route::post('/save-token', [App\Http\Controllers\Controller::class, 'saveToken'])->name('save-token');

Route::post('/send-notification', [App\Http\Controllers\Controller::class, 'sendNotification'])->name('send.notification');


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
