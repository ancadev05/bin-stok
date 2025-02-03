<?php

namespace App\Livewire\Purchase;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

class PurchaseCreateModal extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        $products = Product::all();
        return view('livewire.purchase.purchase-create-modal', compact('products'));
    }
}
