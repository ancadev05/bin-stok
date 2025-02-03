<?php

namespace App\Livewire\Purchase;

use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PurchaseDetails;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class PurchaseEdit extends Component
{
    // tabel pembelian
    public $purchase_code, $supplier_name, $discount, $total_price, $payment_method, $date, $description;
    // tabel pembelian detail
    #[Validate('required', message: 'wajib diisi!')]
    public $purchase_id, $product_id, $purchase_price, $total_products;
    public $total_price_products;

    public function mount($id)
    {
        $purchase = Purchase::find($id);
        
        // dd($purchase);

        $this->purchase_code = $purchase->purchase_code;
        $this->supplier_name = $purchase->supplier_name;
        $this->discount = $purchase->discount;
        $this->total_price = $purchase->total_price;
        $this->payment_method = $purchase->payment_method;
        $this->date = $purchase->date;
        $this->description = $purchase->description;
        $this->purchase_id = $purchase->id;
        $this->total_price_products = $purchase->total_price_products;
        $this->purchase_price = $purchase->purchase_price;
        $this->total_price_products = $purchase->discount_price;
    }


    #[Layout('template-dashboard.main')]
    public function render()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $purchase_details = PurchaseDetails::where('purchase_id', $this->purchase_id)->get();

        return view('livewire.purchase.purchase-edit', compact('suppliers', 'products', 'purchase_details'));
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
        Purchase::find($this->purchase_id)->delete();
        $this->redirectRoute('purchase', navigate: true);
    }
}
