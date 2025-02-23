<?php

namespace App\Livewire\Report;

use App\Exports\PurchaseExport;
use Livewire\Component;
use App\Models\Purchase;
use Livewire\Attributes\Title;
use Maatwebsite\Excel\Facades\Excel;

#[Title("Laporan Pembelian")]
class PurchaseReport extends Component
{
    public $start_date, $end_date;

    public function render()
    {
        $purchases = Purchase::all();

        if ($this->start_date && $this->end_date) {
            $purchases = Purchase::whereBetween('date', [$this->start_date, $this->end_date])->get();
        }

        $this->dispatch('datatables');
        return view('livewire.report.purchase-report', compact('purchases'));
    }

    public function search()
    {
        $this->render();
    }

    public function export()
    {
        return Excel::download(new PurchaseExport, 'laporan-pembelian.xlsx');
    }
}
