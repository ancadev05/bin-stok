<?php

namespace App\Livewire\Purchase;

use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
use Livewire\Attributes\Title;
use App\Models\PurchaseDetails;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Title("Pembelian")]
class PurchaseCreate extends Component
{
    // tabel pembelian
    public $purchase_code, $supplier_name, $total_price, $discount, $discount_price,  $payment_method, $date, $description;
    // tabel pembelian detail
    #[Validate('required', message: 'wajib diisi!')]
    public $purchase_id, $product_id, $purchase_price, $total_products;
    // tambahan
    public $subtotal;

    public function mount($id)
    {
        $purchase = Purchase::where('id', $id)->first();
        $this->purchase_id = $id;
        $this->purchase_code = $purchase->purchase_code;

        $this->discount_price = Purchase::find($this->purchase_id)->total_price;

        $this->subtotal();
    }

    // #[Layout('template-dashboard.main')]
    public function render()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $purchase_details = PurchaseDetails::where('purchase_id', $this->purchase_id)->get();

        // $this->dispatch('select2-init');

        return view('livewire.purchase.purchase-create', compact('suppliers', 'products', 'purchase_details'));
    }

    public function rendered()
    {
        $this->dispatch('select2-init'); // Mengirim event setelah komponen di-render
    }

    public function purchaseDetailsStore()
    {
        // dd($this->purchase_price);
        $this->validate();
        $purchase_total_price = Purchase::find($this->purchase_id)->total_price;

        $product_id = PurchaseDetails::where('purchase_id', $this->purchase_id)
            ->where('product_id', $this->product_id)->count();

        if ($product_id == 0) {

            $purchase_detail = [
                'purchase_id' => $this->purchase_id,
                'product_id' => $this->product_id,
                'purchase_price' => $this->purchase_price,
                'total_products' => $this->total_products,
                'total_price' => $this->purchase_price * $this->total_products,
            ];

            PurchaseDetails::create($purchase_detail);

            $this->product_id = null;
            $this->purchase_price = null;
            $this->total_products = null;

            Purchase::where('id', $this->purchase_id)->update([
                'total_price' => PurchaseDetails::where('purchase_id', $this->purchase_id)->sum('total_price'),
            ]);

            $this->discount_price = Purchase::find($this->purchase_id)->total_price;
        }

        if ($product_id > 0) {

            $total_product = PurchaseDetails::where('purchase_id', $this->purchase_id)
                ->where('product_id', $this->product_id)->first()->total_products;
            $total_product_now = $total_product + $this->total_products;

            $purchase_detail = [
                'purchase_price' => $this->purchase_price,
                'total_products' => $total_product_now,
                'total_price' => $total_product_now * $this->purchase_price,
            ];

            PurchaseDetails::where('product_id', $this->product_id)
                ->where('purchase_id', $this->purchase_id)
                ->update($purchase_detail);

            $this->product_id = null;
            $this->purchase_price = null;
            $this->total_products = null;

            Purchase::where('id', $this->purchase_id)->update([
                'total_price' => PurchaseDetails::where('purchase_id', $this->purchase_id)->sum('total_price'),
            ]);

            $this->discount_price = Purchase::find($this->purchase_id)->total_price;
        }

        $this->subtotal();
        $this->discount();

        $this->dispatch('select2Updated');
    }

    // inisialisasi ulang select2
    public function updatedSelectedItem()
    {
        $this->dispatch('select2Updated');
    }


    // penentuan discount
    public function discount()
    {
        $purchase = Purchase::find($this->purchase_id);
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
        $this->subtotal = PurchaseDetails::where('purchase_id', $this->purchase_id)->sum('total_price');
    }

    public function deleteProduct($id)
    {
        $purchase = Purchase::find($this->purchase_id)->total_price;
        $product = PurchaseDetails::find($id)->total_price;

        Purchase::find($this->purchase_id)->update(['total_price' => $purchase - $product]);

        PurchaseDetails::find($id)->delete();

        $this->subtotal();
        $this->discount();
    }

    public function updated($discount_price)
    {
        $purchase = Purchase::find($this->purchase_id);
        $total_price = $purchase->total_price;

        if ($this->discount >= 0) {
            $discount = $this->discount;
        } else {
            $discount = 0;
        }

        $this->discount_price = $total_price - ($total_price * $discount / 100);
    }

    public function purchaseUndo()
    {
        PurchaseDetails::where('purchase_id', $this->purchase_id)->delete();
        Purchase::find($this->purchase_id)->delete();
        $this->redirectRoute('purchase', navigate: true);
    }

    // proses pembelian
    public function purchaseProcess()
    {
        // penentuan tanggal otomatis
        if ($this->date == null) {
            $this->date = date('Y-m-d');
        }

        // penentuan discount otomatis
        if ($this->discount == null) {
            $this->discount = 0;
        }

        // update data pembelian
        Purchase::find($this->purchase_id)->update([
            'supplier_name' => $this->supplier_name,
            'discount' => $this->discount,
            'discount_price' => $this->discount_price,
            'payment_method' => $this->payment_method,
            'date' => $this->date,
            'status' => 'Selesai',
            'description' => $this->description,
        ]);

        $purchase_details = PurchaseDetails::where('purchase_id', $this->purchase_id)->get();

        // aupdate stok barang
        foreach ($purchase_details as $key => $value) {
            $product = Product::find($value->product_id);
            if ($product) {
                $product->stock += $value->total_products;
                $product->save();
            }
        }

        $this->redirectRoute('purchase', navigate: true);
    }
}
