<?php

use App\Http\Controllers\CategoryController;
use App\Livewire\Category\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/category', function () {
    return view('category.category-index');
});



// Route::resource('category', CategoryController::class);