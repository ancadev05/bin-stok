<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title("Produk")]
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
        $product = Product::find($id);

        if ($product->stock == 0) {
            Product::find($id)->delete();
            session()->flash('status','Data berhasil dihapus!');
        } else {
            session()->flash('status','Produk memiliki stock, TIDAK BISA DIHAPUS!');
        }
    }
}
