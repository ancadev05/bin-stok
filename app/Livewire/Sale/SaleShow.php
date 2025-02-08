<?php

namespace App\Livewire\Sale;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title("Penjualan")]
class SaleShow extends Component
{
    public function render()
    {
        return view('livewire.sale.sale-show');
    }
}
