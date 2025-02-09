<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Dasboard")]

class AdminDashboard extends Component
{
    public $title = "Dashboard";
    // #[Layout("template-dashboard.main")]
    public function render()
    {
        $today = date('Y-m-d');

        $categories = Category::all()->count();
        $products = Product::sum('stock');

        $purchases = Purchase::where('date', $today)->sum('discount_price');
        $purchase_total = Purchase::sum('discount_price');
        $sales = Sale::where('date', $today)->sum('discount_price');
        $sale_total = Sale::sum('discount_price');

        return view('livewire.admin.admin-dashboard', compact(
            'categories',
            'products',
            'purchases',
            'purchase_total',
            'sales',
            'sale_total',
        ));
    }
}
