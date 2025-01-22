<?php

use App\Livewire\Category\Category;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Product\ProductEdit;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Product\ProductIndex;
use App\Livewire\Category\CategoryEdit;
use App\Livewire\Product\ProductCreate;
use App\Livewire\Supplier\SupplierEdit;
use App\Http\Controllers\HomeController;
use App\Livewire\Category\CategoryIndex;
use App\Livewire\Supplier\SupplierIndex;
use App\Livewire\Category\CategoryCreate;
use App\Livewire\Supplier\SupplierCreate;
use App\Http\Controllers\CategoryController;
use App\Livewire\Purchase\PurchaseIndex;

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
    // product
    Route::get('/product', ProductIndex::class)->name('product');
    Route::get('/product/create', ProductCreate::class)->name('product.create');
    Route::get('/product/edit/{id}', ProductEdit::class)->name('product.edit');
    // supplier
    Route::get('/supplier', SupplierIndex::class)->name('supplier');
    Route::get('/supplier/create', SupplierCreate::class)->name('supplier.create');
    Route::get('/supplier/edit/{id}', SupplierEdit::class)->name('supplier.edit');
    // purchase
    Route::get('/purchase', PurchaseIndex::class)->name('purchase');
});