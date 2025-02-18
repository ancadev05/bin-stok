<?php

namespace App\Livewire\Report;

use App\Exports\Report\ReportSalePdf;
use App\Models\Sale;
use Livewire\Component;
use App\Exports\SaleExport;
use App\Models\Company;
use Livewire\Attributes\Title;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Maatwebsite\Excel\Facades\Excel;

#[Title("Laporan Penjualan")]
class SaleReport extends Component
{
    public $pdfUrl;
    public function render()
    {
        $sales = Sale::all();
        return view('livewire.report.sale-report', compact('sales'));
    }

    public function exportExcel()
    {
        return Excel::download(new SaleExport, 'laporan-penjualan.xlsx');
    }
    public function exportPdf()
    {
        // filter
        $company = Company::all();
        $sales = Sale::all();
        $total = Sale::sum('discount_price');
        $pdf = Pdf::loadView('exports.pdf.pdf-report-sale', compact('company','sales', 'total'))->output();
        return response()->streamDownload(
            fn() => print($pdf),
            'laporan-penjualan.pdf'
        );
    }
}
