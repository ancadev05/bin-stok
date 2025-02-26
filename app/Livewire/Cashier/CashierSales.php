<?php

namespace App\Livewire\Cashier;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Models\SalesDetails;
use Illuminate\Support\Facades\Auth;

class CashierSales extends Component
{
    // tabel sales_details
    public $sale_id, $product_id, $sale_price, $total_products, $total_price;
    public function mount($id)
    {
        $sale = Sale::find($id);
        $this->sale_id = $sale->id;
    }
    public function render()
    {
        $sale_id = $this->sale_id;
        $products = Product::all();
        $sales = Sale::where('status', 'k-pending')->get();
        $product_list = SalesDetails::where('sale_id', $this->sale_id)->get();
        return view('livewire.cashier.cashier-sales', compact('sales','products', 'product_list'));
    }

    

    public function addOrder()
    {
        $sale_code = $this->saleCode();
        Sale::create([
            'user_id' => Auth::user()->id,
            'sale_code' => $sale_code,
            'costumer' => 'User',
            'date' => Carbon::now(),
            'status' => 'k-pending',
        ]);

        $sale_id = Sale::where('sale_code', $sale_code)->first()->id;
        
        $this->redirectRoute('cashier.sales', $sale_id);
    }

    public function saleCode()
    {
        $date = date('Y-m-d');
        $last_sale_code = Sale::where('date', $date)->latest()->first();

        if ($last_sale_code) {
            $last_code = intval(substr($last_sale_code->sale_code, -4));
            $new_code = str_pad($last_code + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $new_code = str_pad(1, 4, '0', STR_PAD_LEFT);
        }

        $date = date('d');
        $mount = date('m');
        $sale_code = 'OUT/K-' . $date . $mount . '/' . $new_code;

        return $sale_code;
    }
}
