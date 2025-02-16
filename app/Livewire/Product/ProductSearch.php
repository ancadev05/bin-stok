<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\SalesDetails;
use Livewire\Attributes\Title;
use App\Models\PurchaseDetails;

#[Title("Produk")]
class ProductSearch extends Component
{
    public $code, $product_code, $id; 

    public function mount($id)
    {
        $product = Product::find($id);
        $this->id = $product->id;
    }

    public function render()
    {
        $product = Product::find($this->id);
        $purchases = PurchaseDetails::where('product_id', $this->id)->get();
        $sales = SalesDetails::where('product_id', $this->id)->get();

        return view('livewire.product.product-search', compact('product', 'purchases', 'sales'));
    }
}
