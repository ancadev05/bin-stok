<?php

namespace App\Exports\Report;

use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReportSalePdf implements FromView
{
    public function view(): View
    {
        return view('exports.pdf.pdf-report-sale', [
            'sales' => Sale::all(),
            'total' => Sale::sum('discount_price'),
        ]);
    }
}
