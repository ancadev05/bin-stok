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
class CashierSales extends Component
{
    // tabel sales
    public $sale_code, $costumer, $subtotal, $discount, $discount_price, $payment_method, $date, $status, $description;
    // tabel sales_details
    public $sale_id, $product_id, $sale_price, $total_products, $total_price;
    // variabel bantu
    public $search, $sub_total, $change, $pay;
    public function mount($id)
    {
        $sale = Sale::find($id);
        $this->sale_id = $sale->id;

        $this->date = date('Y-m-d');
        $this->discount = 0;

        $this->subTotal();
        $this->discount();
        $this->total();
    }
    public function render()
    {
        $sale_id = $this->sale_id;
        if ($this->search) {
            $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('product_code', 'like', '%' . $this->search . '%')
            ->orWhere('stock', '>', 0)
            ->get();
        } else {
            $products = Product::where('stock', '>', 0)->get();
        }
        
        $sales = Sale::where('status', 'k-pending')->get();
        $product_list = SalesDetails::where('sale_id', $this->sale_id)->get();
        return view('livewire.cashier.cashier-sales', compact('sales', 'products', 'product_list'));
    }

    public function search()
    {
        $this->render();
    }

    public function addProduct($product_id)
    {
        $product = Product::find($product_id);
        $sale_details = SalesDetails::where('sale_id', $this->sale_id)->where('product_id', $product_id)->first();

        if ($sale_details) {
            $total_products = $sale_details->total_products + 1;
            $total_price = $total_products * $product->selling_price;
            $products = [
                'total_products' => $total_products,
                'total_price' => $total_price,
            ];
            SalesDetails::find($sale_details->id)->update($products);
            Sale::find($this->sale_id)->update([
                'total_price' => SalesDetails::where('sale_id', $this->sale_id)->sum('total_price'),
            ]);
        } else {
            $sale_details = [
                'sale_id' => $this->sale_id,
                'product_id' => $product_id,
                'sale_price' => $product->selling_price,
                'total_products' => 1,
                'total_price' => $product->selling_price,
            ];
            SalesDetails::create($sale_details);
            Sale::find($this->sale_id)->update([
                'total_price' => SalesDetails::where('sale_id', $this->sale_id)->sum('total_price'),
            ]);
        }

        $this->subTotal();
        $this->discount();
        $this->total();
    }

    public function deleteProduct($product_id)
    {
        SalesDetails::find($product_id)->delete();
        $this->subTotal();
        $this->discount();
        $this->total();
        $this->updatedPay();
    }

    public function subTotal()
    {
        $this->sub_total = SalesDetails::where('sale_id', $this->sale_id)->sum('total_price');
    }

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

    public function total()
    {
        $this->total_price = SalesDetails::where('sale_id', $this->sale_id)->sum('total_price');
    }

    // menghitung kembalian
    public function updatedPay()
    {
        if ($this->pay == null) {
            $pay = 0;
        } else {
            $pay = $this->pay;
        }
        $this->change = $pay - $this->total_price;
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

    public function resetProduct($sale_id)
    {
        SalesDetails::where('sale_id', $sale_id)->delete();
        $this->subTotal();
        $this->total();
        $this->reset('pay');
        $this->updatedPay();
    }
    public function cancelTransaction($sale_id)
    {
        SalesDetails::where('sale_id', $sale_id)->delete();
        Sale::find($sale_id)->delete();
        $this->redirectRoute('cashier');
    }

    public function saleProses()
    {
        // mengecek apakah ada produk yang ditambahkan
        $pruduct = SalesDetails::where('sale_id', $this->sale_id);
        if ($pruduct->count() == 0) {
            return $this->dispatch('failed', text: 'Pilih produk terlebih dahulu!');
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

        // penentuan nama default costumer
        empty($this->costumer) ? $costumer = 'Customer' : $costumer = $this->costumer;

        $sale = [
            'costumer' => $costumer,
            'discount' => $this->discount,
            'discount_price' => $this->discount_price,
            'payment_method' => $this->payment_method,
            'date' => $this->date,
            'status' => 'Selesai',
            'description' => $this->description,
        ];

        Sale::find($this->sale_id)->update($sale);

        session()->flash('status', 'Transaksi seelsai!');
        $this->redirectRoute('cashier');
    }
}
