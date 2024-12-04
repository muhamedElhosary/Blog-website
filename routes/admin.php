<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
*/
####### All routes here has admin prefix at url #######
Route::prefix('admin')->group(function () {
    
Route::get('/login', function () {
    return view('admin.login');
});
Route::post('/login',[AdminController::class,'adminLogin'])->name('admin.login');

###### Admin Authenticted ######
Route::middleware('auth:admin')->group(function () {
Route::post('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
Route::get('edit/{id}',[AdminController::class,'edit'])->name('admin.profile.edit');
Route::put('update/{id}',[AdminController::class,'update'])->name('admin.profile.update');
Route::get('waitposts',[PostController::class,'waiting'])->name('post.requests');
Route::put('acceptposts/{id}',[PostController::class,'accept'])->name('post.accept');
Route::delete('decline/{id}',[PostController::class,'decline'])->name('post.decline');

####### Delete Accounts By Admin########
Route::get('users',[AdminController::class,'index'])->name('admin.users');
Route::Delete('soft/{id}',[AdminController::class,'destroy'])->name('soft');
Route::get('trash',[AdminController::class,'deletedAccounts'])->name('trash');
Route::get('restoreitems/{id}',[AdminController::class,'restoreAccounts'])->name('restore');
Route::Delete('force/{id}',[AdminController::class,'forceDelete'])->name('force');
});

});