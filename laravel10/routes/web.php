<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\FilmController;


Route::get('/', function () {
    return view('welcome');
});



Route::resource('films', FilmController::class);
Route::get('contact', [ContactsController::class, 'create'])->name('contact.create');
Route::post('contact', [ContactsController::class, 'store'])->name('contact.store');



Route::controller(FilmController::class)->group(function () {
    Route::delete('films/force/{film}', 'forceDestroy')->name('films.force.destroy');
    Route::put('films/restore/{film}', 'restore')->name('films.restore');
    Route::get('category/{slug}/films', 'index')->name('films.category');
    
});