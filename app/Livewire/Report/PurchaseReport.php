<?php

namespace App\Livewire\Report;

use Livewire\Component;
use App\Models\Purchase;
use Livewire\Attributes\Title;

#[Title("Laporan Penjualan")]
class PurchaseReport extends Component
{
    public $start_date, $end_date;

    public function render()
    {
        $purchases = Purchase::all();
        return view('livewire.report.purchase-report', compact('purchases'));
    }

    
}
