<?php

namespace App\Livewire\Cashier;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Models\SalesDetails;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title("Kasir")]
class CashierIndex extends Component
{
    // tabel sales
    public $sale_code, $costumer, $subtotal, $discount, $discount_price, $payment_method, $date, $status, $description;
    // tabel sales_details
    public $sale_id, $product_id, $sale_price, $total_products, $total_price;

    // tabel product
    public $max_stock, $min_stock;
    // variabel bantu
    public $sale_price2, $total_price2, $pay, $change;
    public $search;

    public $list_products = [];

    public $saya=[];
    public function render()
    {
        if ($this->search) {
            $products = Product::where('product_code', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->get();
        } else {
            $products = Product::all();
        }

        $sales = Sale::where('status', 'k-pending')->get();

        return view(
            'livewire.cashier.cashier-index',
            compact(
                'products',
                'sales',
            )
        );
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

        $this->sale_id = Sale::where('sale_code', $sale_code)->first()->id;
    }

    public function addProduct($id)
    {
        $sale_details = [
            'sale_id' => $this->sale_id,
            'product_id' => $this->product_id,
            'sale_price' => $this->sale_price2,
            'total_products' => $this->total_products,
            'total_price' => $this->total_price2,
        ];

        SalesDetails::create($sale_details);
    }

    public function remove($id)
    {
        $index = array_search($id, $this->list_products);
        if ($index) {
            unset($this->list_products[$index]);
            $this->list_products = array_values($this->list_products); // re-index array
        }
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
