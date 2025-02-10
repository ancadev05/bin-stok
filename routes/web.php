<?php

use App\Models\Purchase;
use App\Livewire\Sale\SaleShow;
use App\Livewire\User\UserEdit;
use App\Livewire\Sale\SaleIndex;
use App\Livewire\User\UserIndex;
use App\Livewire\Sale\SaleCreate;
use App\Livewire\User\UserCreate;
use App\Livewire\Category\Category;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Company\CompanyEdit;
use App\Livewire\Product\ProductEdit;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Company\CompanyIndex;
use App\Livewire\Product\ProductIndex;
use App\Livewire\Setting\SettingIndex;
use App\Livewire\Category\CategoryEdit;
use App\Livewire\Product\ProductCreate;
use App\Livewire\Purchase\PurchaseEdit;
use App\Livewire\Purchase\PurchaseShow;
use App\Livewire\Report\PurchaseReport;
use App\Livewire\Supplier\SupplierEdit;
use App\Http\Controllers\HomeController;
use App\Livewire\Category\CategoryIndex;
use App\Livewire\Purchase\PurchaseIndex;
use App\Livewire\Supplier\SupplierIndex;
use App\Livewire\Category\CategoryCreate;
use App\Livewire\Purchase\PurchaseCreate;
use App\Livewire\Supplier\SupplierCreate;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return redirect('/login');
});

// Route::get('/category', function () {
//     return view('category.category-index');
// });

Route::get('/kaiadmin', function () {
    // dd('ok');
    return view('kaiadmin');
});



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
    Route::get('/purchase/create/{id}', PurchaseCreate::class)->name('purchase.create');
    Route::get('/purchase/show/{id}', PurchaseShow::class)->name('purchase.show');
    Route::get('/purchase/edit/{id}', PurchaseEdit::class)->name('purchase.edit');
    // sell
    Route::get('/sale', SaleIndex::class)->name('sale');
    Route::get('/sale/create/{id}', SaleCreate::class)->name('sale.create');
    Route::get('/sale/show/{id}', SaleShow::class)->name('sale.show');
    // report
    Route::get('/report-purchase', PurchaseReport::class)->name('report-purchase');
    Route::get('/export-purchase', [PurchaseReport::class, 'export'])->name('export.purchase');
    // user
    Route::get('/users', UserIndex::class)->name('users');
    Route::get('/users/create', UserCreate::class)->name('users.create');
    Route::get('/users/edit/{id}', UserEdit::class)->name('users.edit');
    // company
    Route::get('/company', CompanyIndex::class)->name('company');
    Route::get('/company/edit/{id}', CompanyEdit::class)->name('company.edit');

    Route::get('coba', function () {

        return view('exports.report-purchase', [
            'purchases' => Purchase::all(),
            'total' => Purchase::sum('discount_price'),
        ] );
    });
});
