<?php

namespace App\Livewire\Purchase;

use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PurchaseDetails;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class PurchaseCreate extends Component
{
    // tabel pembelian
    public $purchase_code, $supplier_name, $discount, $total_price, $payment_method, $date, $description;
    // tabel pembelian detail
    #[Validate('required', message: 'wajib diisi!')]
    public $purchase_id, $product_id, $purchase_price, $total_products;
    public $total_price_products;

    public function mount($id)
    {
        $purchase = Purchase::where('id', $id)->first();
        $this->purchase_id = $id;
        $this->purchase_code = $purchase->purchase_code;

        $this->total_price_products = Purchase::find($this->purchase_id)->total_price;
    }

    #[Layout('template-dashboard.main')]
    public function render()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $purchase_details = PurchaseDetails::where('purchase_id', $this->purchase_id)->get();

        return view('livewire.purchase.purchase-create', compact('suppliers', 'products', 'purchase_details'));
    }

    public function purchaseDetailsStore()
    {
        $this->validate();
        $purchase_total_price = Purchase::find($this->purchase_id)->total_price;

        $product_id = PurchaseDetails::where('purchase_id', $this->purchase_id)
            ->where('product_id', $this->product_id)->count();

        // dd($product_id);

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

            $this->total_price_products = Purchase::find($this->purchase_id)->total_price;
        }

        if ($product_id > 0) {

            $total_product = PurchaseDetails::where('product_id', $this->product_id)->first()->total_products;
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

            $this->total_price_products = Purchase::find($this->purchase_id)->total_price;
        }
    }

    public function deleteProduct($id)
    {
        $purchase = Purchase::find($this->purchase_id)->total_price;
        $product = PurchaseDetails::find($id)->total_price;

        Purchase::find($this->purchase_id)->update(['total_price' => $purchase - $product]);

        PurchaseDetails::find($id)->delete();
    }

    public function updated($total_price_products)
    {
        $purchase = Purchase::find($this->purchase_id);
        $total_price = $purchase->total_price;

        if ($this->discount >= 0) {
            $discount = $this->discount;
        } else {
            $discount = 0;
        }

        $this->total_price_products = $total_price - ($total_price * $discount / 100);
    }

    public function purchaseUndo()
    {
        PurchaseDetails::where('purchase_id', $this->purchase_id)->delete();
        Purchase::find( $this->purchase_id)->delete();
        $this->redirectRoute('purchase');
    }
}
