<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/auth')->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginAction'])->name('Login.Action');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerAction'])->name('register.Action');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('/admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('home.admin');

    Route::get('/profile/{userid}', [AdminController::class, 'profileUser'])->name('profile.user');
    Route::post('/profile/{userid}', [AdminController::class, 'profileUserEditAction'])->name('profileEdit.action');

    Route::get('/pages', [AdminController::class, 'getPages'])->name('getPages');
    Route::get('/addpage', [AdminController::class, 'addPage'])->name('addPage');
    Route::post('/addpage', [AdminController::class, 'addPageAction'])->name('addPage.Action');
    Route::get('/{slug}/editpage/{pageid}', [AdminController::class, 'editPage'])->name('editPage');
    Route::post('/{slug}/editpage/{pageid}', [AdminController::class, 'editPageAction'])->name('editPage.Action');
    Route::get('/{slug}/delpage/{pageid}', [AdminController::class, 'delPage'])->name('delPage');

    Route::get('/{slug}/links', [AdminController::class, 'pageLinks'])->name('page.Links');
    Route::get('/{slug}/stats', [AdminController::class, 'pageStats'])->name('page.Stats');

    Route::get('/linkorder/{linkid}/{pos}', [AdminController::class, 'linkOrderUpdate'])->name('linkOrder.Update');

    Route::get('/{slug}/newlink', [AdminController::class, 'newlink'])->name('newlink');
    Route::post('/{slug}/newlink', [AdminController::class, 'newLinkAction'])->name('newLink.Action');
    Route::get('/{slug}/editlink/{linkid}', [AdminController::class, 'editLink'])->name('editLink');
    Route::post('/{slug}/editlink/{linkid}', [AdminController::class, 'editLinkAction'])->name('editLink.Action');
    Route::get('/{slug}/dellink/{linkid}', [AdminController::class, 'delLink'])->name('delLink');

});

Route::get('/{slug}', [PageController::class, 'index'])->name('page');
Route::post('/{slug}/addclick', [PageController::class, 'addClick'])->name('page.addclick');
