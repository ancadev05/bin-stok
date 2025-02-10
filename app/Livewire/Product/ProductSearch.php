<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\SalesDetails;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Illuminate\Support\Str;

class ProductSearch extends Component
{
    public $code, $product_code, $id; 

    public function mount($id)
    {
        // dd($code);

        $product_code = Str::upper($this->code);
        $product = Product::find($id);
        $this->id = $product->id;
    }

    public function searchProduct()
    {
        dd($this->code);
        $this->redirect('/product/search/' . $this->code);
    }
    public function render()
    {
        $product = Product::find($this->id);
        $purchases = Purchase::where('discount_price', '>', 0)->where('product_id', $this->id)->get();
        $sales = SalesDetails::where('product_id', $this->id)->get();
        return view('livewire.product.product-search', compact('product', 'purchases', 'sales'));
    }
}
