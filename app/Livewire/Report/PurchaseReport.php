<?php

namespace App\Livewire\Report;

use App\Exports\PurchaseExport;
use Livewire\Component;
use App\Models\Purchase;
use Livewire\Attributes\Title;
use Maatwebsite\Excel\Facades\Excel;

#[Title("Laporan Penjualan")]
class PurchaseReport extends Component
{
    public $start_date, $end_date;

    public function render()
    {
        $purchases = Purchase::all();
        return view('livewire.report.purchase-report', compact('purchases'));
    }

    public function export()
    {
        return Excel::download(new PurchaseExport, 'laporan-penjualan.xlsx');
    }

    
}
