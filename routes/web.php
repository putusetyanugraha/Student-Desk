<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguangeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'redirectToLogin');
    Route::get('login', 'showLogin')->name('login.view');
    Route::post('login', 'login')->name('login.do');
    Route::get('register', 'showRegister')->name('register.view');
    Route::post('register', 'register')->name('register.do');
});

Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
    Route::get('list', 'index')->name('list');
    Route::get('detail/{productId}', 'show')->name('detail');
});

Route::controller(AboutController::class)->group(function () {
    Route::get('about', 'index');
    Route::get('kontak-kami', 'redirectFromContact');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('students')->name('students.')->controller(StudentController::class)->group(function () {
    Route::get('create', 'showCreate')->name('create');
    Route::post('create', 'insertStudent')->name('insert');
    Route::post('score/insert', 'insertScore')->name('scores.insert');
    Route::post('predict/{id}', 'predictScore')->name('predict');
    Route::get('update/{id}', 'showEdit')->name('edit');
    Route::patch('update/{id}', 'studentUpdate')->name('update');
    Route::delete('delete/{id}', 'studentDelete')->name('delete');
    Route::get('{id}', 'detail')->name('detail');
});

Route::get('language/{locale}', [LanguangeController::class, 'switch'])
    ->middleware('web')
    ->name('language.switch');
    