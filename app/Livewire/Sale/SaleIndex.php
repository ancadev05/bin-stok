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
        $sale_code = $this->saleCode();
        Sale::create([
            'sale_code' => $sale_code,
            'costumer' => 'User',
            'date' => Carbon::now()
        ]);

        $sale_id = Sale::where('sale_code', $sale_code)->first()->id;

        $this->redirect('sale/create/' . $sale_id, navigate: true);
    }

    public function saleCode()
    {
        $date = date('Y-m-d');
        $last_sale_code = Sale::where('date', $date)->latest()->first();

        if ($last_sale_code) {
            $last_code = intval(substr($last_sale_code->sale_code, -4));
            $new_code = str_pad($last_code + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $new_code = str_pad(1, 4, '0', STR_PAD_LEFT);
        }

        $sale_code = 'OUT-' . date('d') . date('m') . '/' . $new_code;

        return $sale_code;
    }
}
