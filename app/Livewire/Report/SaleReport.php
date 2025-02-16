<?php

namespace App\Livewire\Report;

use App\Models\Sale;
use Livewire\Component;

class SaleReport extends Component
{
    public function render()
    {
        $sales = Sale::all();
        return view('livewire.report.sale-report', compact('sales'));
    }
}
