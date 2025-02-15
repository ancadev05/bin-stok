<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Title("Produk")]
class ProductIndex extends Component
{
    // #[Layout('template-dashboard.main')]
    public function render()
    {
        $products = Product::all();
        return view('livewire.product.product-index', compact('products'));
    }

    #[On('destroy')]
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product->stock == 0) {
            Storage::disk('public')->delete($product->images);
            Product::find($id)->delete();
            $this->dispatch('success', text:'Data berhasil dihapus!');
        } else {
            $this->dispatch('failed', text:'Data tidak dapat dihapus!');
        }
    }
}
