<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublicationController;
use App\Models\Publication;

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

Route::get('dashboard', [ClientAuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('login', [ClientAuthController::class, 'index'])->name('login');
Route::post('client-login', [ClientAuthController::class, 'clientLogin'])->name('login.client'); 
Route::get('registration', [ClientAuthController::class, 'registration'])->name('register-user');
Route::post('client-registration', [ClientAuthController::class, 'clientRegistration'])->name('register.client'); 
Route::get('signout', [ClientAuthController::class, 'signOut'])->name('signout');

Route::get('newsfeed', [PublicationController::class,'index'])->name('newsfeed');
Route::post('customPublication', [PublicationController::class,'store'])->name('customPublication');
Route::get('newsfeed/{id}', [PublicationController::class,'show'])->name('newsfeedSolo');
Route::get('newsfeed/edit/{id}', [PublicationController::class, 'edit'])->name('editPublication');
Route::patch('newsfeed/update/{id}', [PublicationController::class, 'update'])->name('updatePublication');
Route::delete('newsfeed/destroy/{id}', [PublicationController::class, 'destroy'])->name('deletePublication');

Route::post('/comment/store', [CommentController::class,'store'])->name('commentAdd')->middleware('auth');

