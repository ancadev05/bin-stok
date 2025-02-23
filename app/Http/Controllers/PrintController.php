<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\Sale;
use App\Models\Company;
use App\Models\SalesDetails;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printPurchase($id)
    {
        $company = Company::first();
        $purchase = Purchase::find($id);
        $purchase_details = PurchaseDetails::where('purchase_id', $id)->get();
        
        return view('exports.print.print-invoice-purchase', compact(
            'company', 'purchase', 'purchase_details'
        ));
    }
    public function printSale($id)
    {
        $company = Company::first();
        $sale = Sale::find($id);
        $sale_details = SalesDetails::where('sale_id', $id)->get();
        
        return view('exports.print.print-invoice-sale', compact(
            'company', 'sale', 'sale_details'
        ));
    }
}
