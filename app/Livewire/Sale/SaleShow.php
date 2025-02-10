<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use App\Models\Company;
use App\Models\SalesDetails;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title("Penjualan")]
class SaleShow extends Component
{
    public $sale_id;

    public function mount($id)
    {
        $sale = Sale::find($id);
        $this->sale_id = $sale->id;
    }

    public function render()
    {
        $company = Company::first();
        $sale = Sale::find($this->sale_id);
        $sale_details = SalesDetails::where('sale_id', $this->sale_id)->get();

        return view('livewire.sale.sale-show', compact('company', 'sale', 'sale_details'));
    }
}
