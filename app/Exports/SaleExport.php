<?php

namespace App\Exports;

use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class SaleExport implements FromView
{
    public function view(): View
    {
        return view('exports.excel.report-sale', [
            'sales' => Sale::all(),
            'total' => Sale::sum('discount_price'),
        ]);
    }
}
