<?php

namespace App\Livewire\Admin;

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

        $products = Product::all()->sum('stock');
        $purchases = Purchase::where('date', $today)->sum('discount_price');
        $sales = Sale::where('date', $today)->sum('discount_price');

        return view('livewire.admin.admin-dashboard', compact(
            'products',
            'purchases',
            'sales',
        ));
    }
}
