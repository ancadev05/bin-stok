<?php

namespace App\Livewire\Report;

use App\Models\Sale;
use Livewire\Component;
use App\Exports\SaleExport;
use Livewire\Attributes\Title;
use Maatwebsite\Excel\Facades\Excel;

#[Title("Laporan Penjualan")]
class SaleReport extends Component
{
    public function render()
    {
        $sales = Sale::all();
        return view('livewire.report.sale-report', compact('sales'));
    }

    public function export()
    {
        return Excel::download(new SaleExport, 'laporan-penjualan.xlsx');
    }
}
