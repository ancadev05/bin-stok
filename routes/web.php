<?php

use App\Livewire\Category\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Category\CategoryIndex;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/category', function () {
//     return view('category.category-index');
// });

Route::get('/category', CategoryIndex::class)->name('category');



// Route::resource('category', CategoryController::class);
Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
});