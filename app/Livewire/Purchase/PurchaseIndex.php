<?php

namespace App\Livewire\Purchase;

use App\Models\Product;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\Attributes\Layout;

class PurchaseIndex extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        $suppliers = Supplier::all();
        $products = Product::all();

        return view('livewire.purchase.purchase-index', compact('suppliers', 'products'));
    }
}
