<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

###### Verify User Accounts ######
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

####### user profile routes #########
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

########## public routes With MultiLanguage ############
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
Route::get('/',[PostController::class,'index'])->name('home');
Route::view('privacy','privacy');
Route::view('conditions','conditions');
Route::view('contact','contact');

// ########## middleware applied but in their controllers ############

Route::get('postuser/{id}',[PostController::class,'postUser'])->name('post.user');
Route::resource('contact',MessageController::class);
Route::resource('post',PostController::class);
Route::resource('comments',CommentsController::class);
Route::get('search',[PostController::class,'search'])->name('post.search');
Route::get('singlepage/{id}',[PostController::class,'show'])->name('single');
});


#####Social Login#######
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back',[GoogleAuthController::class,'callbackGoogle']);

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
