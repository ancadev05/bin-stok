<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ProductIndex extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        $products = Product::all();
        return view('livewire.product.product-index', compact('products'));
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
    }
}
