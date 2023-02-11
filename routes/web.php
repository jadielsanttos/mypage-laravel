<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index']);

Route::prefix('/admin')->group(function(){
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/login', [AdminController::class, 'loginAction']);

    Route::get('/register', [AdminController::class, 'register']);
    Route::post('/register', [AdminController::class, 'registerAction']);
    Route::get('/logout', [AdminController::class, 'logout']);

    Route::get('/', [AdminController::class, 'index']);

    Route::get('/addpage', [AdminController::class, 'addPage']);
    Route::post('/addpage', [AdminController::class, 'addPageAction']);
    Route::get('/{slug}/editpage/{pageid}', [AdminController::class, 'editPage']);
    Route::post('/{slug}/editpage/{pageid}', [AdminController::class, 'editPageAction']);
    Route::get('/{slug}/delpage/{pageid}', [AdminController::class, 'delPage']);

    Route::get('/{slug}/links', [AdminController::class, 'pageLinks']);
    Route::get('/{slug}/stats', [AdminController::class, 'pageStats']);

    Route::get('/linkorder/{linkid}/{pos}', [AdminController::class, 'linkOrderUpdate']);

    Route::get('/{slug}/newlink', [AdminController::class, 'newlink']);
    Route::post('/{slug}/newlink', [AdminController::class, 'newLinkAction']);
    Route::get('/{slug}/editlink/{linkid}', [AdminController::class, 'editLink']);
    Route::post('/{slug}/editlink/{linkid}', [AdminController::class, 'editLinkAction']);
    Route::get('/{slug}/dellink/{linkid}', [AdminController::class, 'delLink']);

});

Route::get('/{slug}', [PageController::class, 'index']);
