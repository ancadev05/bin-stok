<?php

use App\Models\Sale;
use App\Models\Company;
use App\Models\Purchase;
use App\Livewire\Sale\SaleShow;
use App\Livewire\User\UserEdit;
use App\Models\PurchaseDetails;
use App\Livewire\Sale\SaleIndex;
use App\Livewire\User\UserIndex;
use App\Livewire\Sale\SaleCreate;
use App\Livewire\User\UserCreate;
use App\Livewire\Category\Category;
use App\Livewire\Report\SaleReport;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Company\CompanyEdit;
use App\Livewire\Product\ProductEdit;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Cashier\CashierIndex;
use App\Livewire\Company\CompanyIndex;
use App\Livewire\Product\ProductIndex;
use App\Livewire\Setting\SettingIndex;
use App\Livewire\Category\CategoryEdit;
use App\Livewire\Product\ProductCreate;
use App\Livewire\Product\ProductSearch;
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
use App\Http\Controllers\PrintController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


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
    Route::get('/product/search/{id}', ProductSearch::class)->name('product.search');
    // supplier
    Route::get('/supplier', SupplierIndex::class)->name('supplier');
    Route::get('/supplier/create', SupplierCreate::class)->name('supplier.create');
    Route::get('/supplier/edit/{id}', SupplierEdit::class)->name('supplier.edit');
    // purchase
    Route::get('/purchase', PurchaseIndex::class)->name('purchase');
    Route::get('/purchase/create/{id}', PurchaseCreate::class)->name('purchase.create');
    Route::get('/purchase/show/{id}', PurchaseShow::class)->name('purchase.show');
    // sell
    Route::get('/sale', SaleIndex::class)->name('sale');
    Route::get('/sale/create/{id}', SaleCreate::class)->name('sale.create');
    Route::get('/sale/show/{id}', SaleShow::class)->name('sale.show');
    Route::get('/sale/print/{id}', [SaleShow::class, 'printTransaction'])->name('sale.print');
    // report
    Route::get('/report-purchase', PurchaseReport::class)->name('report.purchase');
    Route::get('/report-sale', SaleReport::class)->name('report.sale');
    // print transaction
    Route::get('/print-invoice-purchase/{id}', [PrintController::class, 'printPurchase'])->name('print.invoice.purchase');
    Route::get('/print-invoice-sale/{id}', [PrintController::class, 'printSale'])->name('print.invoice.sale');
    // cashier
    Route::get('/cashier', CashierIndex::class)->name('cashier');
    // user
    Route::get('/users', UserIndex::class)->name('users');
    Route::get('/users/create', UserCreate::class)->name('users.create');
    Route::get('/users/edit/{id}', UserEdit::class)->name('users.edit');
    // company
    Route::get('/company', CompanyIndex::class)->name('company');
    Route::get('/company/edit/{id}', CompanyEdit::class)->name('company.edit');

    Route::get('coba', function () {

        return view('exports.pdf.pdf-report-sale', [
            'company' => Company::all(),
            'sales' => Sale::all(),
            'total' => Sale::sum('discount_price'),
        ] );
    });
    Route::get('cetak', function () {

        return view('exports.pdf.pdf-transaction-purchase', [
            'company' => Company::all(),
            'purchase' => Purchase::first(),
            'purchase_details' => PurchaseDetails::where('purchase_id', Purchase::first()->id)->get(),
        ] );
    });
});
