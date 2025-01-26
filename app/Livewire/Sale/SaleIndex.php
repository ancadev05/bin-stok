<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use Livewire\Component;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;

class SaleIndex extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        $sales = Sale::all();
        return view('livewire.sale.sale-index', compact('sales'));
    }

    public function saleCreate()
    {
        $sale_code = 'OUT-' . time();
        Sale::create([
            'sale_code' => $sale_code,
            'costumer' => 'User',
            'date' => Carbon::now()
        ]);

        $sale_id = Sale::where('sale_code', $sale_code)->first()->id;

        $this->redirect('sale/create/' . $sale_id, navigate: true);
    }
}
