<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Models\SalesDetails;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title("Penjualan")]
class SaleCreate extends Component
{
    // tabel sales
    public $sale_code, $costumer, $subtotal, $discount, $discount_price, $payment_method, $date, $status, $description;
    // tabel sales_details
    public $sale_id, $product_id, $sale_price, $total_products, $total_price;

    // tabel product
    public $max_stock, $min_stock;
    // variabel bantu
    public $sale_price2, $total_price2, $pay, $change;

    public function mount($id)
    {
        $sale = Sale::find($id);
        $this->sale_id = $sale->id;
        $this->sale_code = $sale->sale_code;

        $this->date = date('Y-m-d');
        $this->discount = 0;

        $this->subtotal();
        $this->discount();
    }

    // #[Layout('template-dashboard.main')]
    public function render()
    {
        $products = Product::all();
        $sale_details = SalesDetails::where('sale_id', $this->sale_id)->get();
        return view('livewire.sale.sale-create', compact('products', 'sale_details'));
    }

    // update nilai
    public function updatedProductId()
    {
        $this->stockPrice();
    }
    public function updatedTotalProducts()
    {
        $this->stockPrice();
    }
    public function updatedDiscount()
    {
        $this->discount();
        $this->updatedPay();
    }

    public function updatedPay()
    {
        if($this->pay == null) {
            $pay = 0;
        } else {
            $pay = $this->pay;
        }
        $this->change = 'Rp. ' . number_format($pay - $this->discount());
    }

    public function saleDetailsStore()
    {
        $this->validate([
            'product_id' => 'required',
            'total_products' => 'required'
        ], [
            'product_id.required' => 'Pilih produk!',
            'total_products.required' => 'Produk minimal 1!'
        ]);

        $sale_details = [
            'sale_id' => $this->sale_id,
            'product_id' => $this->product_id,
            'sale_price' => $this->sale_price2,
            'total_products' => $this->total_products,
            'total_price' => $this->total_price2,
        ];

        SalesDetails::create($sale_details);

        Sale::find($this->sale_id)->update([
            'total_price' => SalesDetails::where('sale_id', $this->sale_id)->sum('total_price'),
        ]);

        $this->subtotal();
        $this->discount();
        $this->updatedPay();

        $this->total_products = null;
        $this->sale_price = null;
        $this->total_price = null;
    }

    public function deleteProduct($id)
    {
        $sale = Sale::find($this->sale_id)->total_price;
        $sale_details = SalesDetails::find($id)->total_price;

        Sale::find($this->sale_id)->update(['total_price' => $sale - $sale_details]);
        SalesDetails::find($id)->delete();

        $this->subtotal();
        $this->discount();
        $this->updatedPay();
    }

    // update stok dan harga produk
    public function stockPrice()
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

        return $this->discount_price = $total_price - ($total_price * $discount / 100);
    }

    // menghitung subtotal
    public function subtotal()
    {
        $this->subtotal = SalesDetails::where('sale_id', $this->sale_id)->sum('total_price');
    }

    public function saleUndo()
    {
        SalesDetails::where('sale_id',$this->sale_id)->delete();
        Sale::find($this->sale_id)->delete();
        $this->redirectRoute('sale');
    }

    public function saleProcess()
    {
        // mengecek apakah ada produk yang ditambahkan
        $pruduct = SalesDetails::where('sale_id', $this->sale_id);
        if ($pruduct->count() == 0) {
            return $this->dispatch('failed');
        }


        // update stok barang
        $sale_details = SalesDetails::where('sale_id', $this->sale_id)->get();
        foreach ($sale_details as $key => $value) {
            $product = Product::find($value->product_id);
            if ($product) {
                $product->stock -= $value->total_products;
                $product->save();
            }
        }

        $sale = [
            'costumer' => $this->costumer,
            'discount' => $this->discount,
            'discount_price' => $this->discount_price,
            'payment_method' => $this->payment_method,
            'date' => $this->date,
            'status' => 'Selesai',
            'description' => $this->description,
        ];

        Sale::find($this->sale_id)->update($sale);

        session()->flash('status', 'Transaksi selesai!');

        $this->redirectRoute('sale');
    }

}
