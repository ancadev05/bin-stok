<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use App\Models\SalesDetails;
use Livewire\Attributes\Layout;

class SaleCreate extends Component
{
    // tabel sales
    public $sale_code, $costumer, $total_price, $discount, $discount_price, $payment_method, $date, $status, $description;
    // tabel sales_details
    public $sale_id, $product_id, $sale_price, $total_products ; 

    public function mount($id)
    {
        $sale = Sale::find($id);
        $this->sale_id = $sale->id;
        $this->sale_code = $sale->sale_code;
    }

    #[Layout('template-dashboard.main')]
    public function render()
    {
        $products = Product::all();
        $sale_details = SalesDetails::where('sale_id', $this->sale_id)->get();
        return view('livewire.sale.sale-create', compact('products', 'sale_details'));
    }

    public function saleDetailsStore()
    {

    }

    // penentuan discount
    public function discount()
    {
        $purchase = Sale::find($this->purchase_id);
        $total_price = $purchase->total_price;

        if ($this->discount >= 0) {
            $discount = $this->discount;
        } else {
            $discount = 0;
        }

        $this->discount_price = $total_price - ($total_price * $discount / 100);
    }

    // menghitung subtotal
    public function subtotal()
    {
        $this->subtotal = SalesDetails::where('sale_id', $this->purchase_id)->sum('total_price');
    }
}
