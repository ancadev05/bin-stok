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
    public $sale_code, $costumer, $subtotal, $discount, $discount_price, $payment_method, $date, $status, $description;
    // tabel sales_details
    public $sale_id, $product_id, $sale_price, $total_products, $total_price;

    // tabel product
    public $max_stock, $min_stock;
    // variabel bantu
    public $sale_price2, $total_price2;

    public function mount($id)
    {
        $sale = Sale::find($id);
        $this->sale_id = $sale->id;
        $this->sale_code = $sale->sale_code;

        $this->subtotal();
    }

    #[Layout('template-dashboard.main')]
    public function render()
    {
        $products = Product::all();
        $sale_details = SalesDetails::where('sale_id', $this->sale_id)->get();
        return view('livewire.sale.sale-create', compact('products', 'sale_details'));
    }

    // update nilai
    public function updated()
    {
        $product = Product::find($this->product_id);

        // update stok produk tersisa
        $this->max_stock = $product->stock;
        $this->min_stock = 1;

        // update harga produk
        $this->sale_price = 'Rp. ' . number_format($product->selling_price);
        $this->sale_price2 = $product->selling_price;

        // update total harga
        $this->total_price = 'Rp. ' . number_format($this->total_products * $product->selling_price);
        $this->total_price2 = $this->total_products * $product->selling_price;
    }

    public function saleDetailsStore()
    {
        $sale_details = [
            'sale_id' => $this->sale_id,
            'product_id' => $this->product_id,
            'sale_price' => $this->sale_price2,
            'total_products' => $this->total_products,
            'total_price' => $this->total_price2,
        ];

        SalesDetails::create($sale_details);

        $this->subtotal();
    }

    public function deleteProduct($id)
    {
        $sale = Sale::find($this->sale_id)->total_price;
        $sale_details = SalesDetails::find($id)->total_price;

        Sale::find($this->sale_id)->update(['total_price' => $sale - $sale_details]);

        SalesDetails::find($id)->delete();

        $this->subtotal();
        $this->discount();
    }

    // penentuan discount
    public function discount()
    {
        $sale = Sale::find($this->sale_id);
        $total_price = $sale->total_price;

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
        $this->subtotal = SalesDetails::where('sale_id', $this->sale_id)->sum('total_price');
    }

}
