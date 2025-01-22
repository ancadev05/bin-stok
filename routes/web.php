<?php

use App\Livewire\Category\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Category\CategoryEdit;
use App\Livewire\Category\CategoryIndex;
use App\Livewire\Category\CategoryCreate;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/category', function () {
//     return view('category.category-index');
// });




// Route::resource('category', CategoryController::class);
Auth::routes(['register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');

    // category
    Route::get('/category', CategoryIndex::class)->name('category');
    Route::get('/category/create', CategoryCreate::class)->name('category.create');
    Route::get('/category/edit/{id}', CategoryEdit::class)->name('category.edit');
});