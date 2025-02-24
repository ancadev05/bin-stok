<?php

namespace App\Livewire\Report;

use App\Models\Company;
use Livewire\Component;
use App\Models\Purchase;
use Livewire\Attributes\Title;
use App\Exports\PurchaseExport;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function exportExcel()
    {
        return Excel::download(new PurchaseExport, 'laporan-pembelian.xlsx');
    }

    public function exportPdf()
    {
        // filter
        $company = Company::all();

        $purchases = Purchase::all();
        $total = Purchase::sum('discount_price');

        if ($this->start_date && $this->end_date) {
            $purchases = Purchase::whereBetween('date', [$this->start_date, $this->end_date])->get();
            $total = $purchases->sum('discount_price');
        }

        $pdf = Pdf::loadView('exports.pdf.pdf-report-purchase', compact('company','purchases', 'total'))->output();
        return response()->streamDownload(
            fn() => print($pdf),
            'laporan-pembelian.pdf'
        );
    }
}
