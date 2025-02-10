<?php

namespace App\Exports;

use App\Models\Purchase;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

// class PurchaseExport implements FromCollection
class PurchaseExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Purchase::all();
    // }

    public function view(): View
    {
        return view('exports.report-purchase', [
            'purchases' => Purchase::all(),
            'total' => Purchase::sum('discount_price'),
        ]);
    }
}
