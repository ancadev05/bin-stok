<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BarcodeController extends Controller
{
    public function barcodeProducts()
    {
        $products = Product::all();
        $no = 1;

        // $pdf = Pdf::loadView('exports.barcode.barcode-products', compact('products', 'no'));
        // return $pdf->stream('barcode-products.pdf');

        return view('exports.barcode.barcode-products', compact('products', 'no'));
    }
}
