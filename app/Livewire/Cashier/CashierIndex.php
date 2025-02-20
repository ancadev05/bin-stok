<?php

namespace App\Livewire\Cashier;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title("Kasir")]
class CashierIndex extends Component
{
    public $search;
    public $list_products = [];

    public $saya=[];
    public function render()
    {
        if ($this->search) {
            $products = Product::where('product_code', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->get();
        } else {
            $products = Product::all();
        }

        return view(
            'livewire.cashier.cashier-index',
            compact(
                'products',
            )
        );
    }

    public function add($id)
    {
        $product = Product::find($id);
        $this->list_products[] = $product;
    }

    public function remove($id)
    {
        $index = array_search($id, $this->list_products);
        if ($index) {
            unset($this->list_products[$index]);
            $this->list_products = array_values($this->list_products); // re-index array
        }
    }
}
