<?php

namespace App\Livewire\Purchase;

use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use App\Models\PurchaseDetails;
use Livewire\Attributes\Layout;
use PhpParser\Node\Expr\FuncCall;

class PurchaseCreate extends Component
{
    #[Layout('template-dashboard.main')]
    // tabel pembelian
    public $purchase_code, $supplier_name, $discount, $total_price, $payment_method, $date, $description;
    // tabel pembelian detail
    public $purchase_id, $product_id, $purchase_price, $total_products;
    public $total_price_products;

    public function mount($id)
    {
        $purchase = Purchase::where('id', $id)->first();
        $this->purchase_id = $id;
        $this->purchase_code = $purchase->purchase_code;
    }

    public function render()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        $purchase_details = PurchaseDetails::where('purchase_id', $this->purchase_id);
        
        return view('livewire.purchase.purchase-create', compact(
            'suppliers', 
            'products', 
            'purchase_details',
        ));
    }

    public function purchaseDetailsStore()
    {

        $purchase_detail = [
            'purchase_id' => $this->purchase_id,
            'product_id' => $this->product_id,
            'purchase_price' => $this->purchase_price,
            'total_products' => $this->total_products,
            'total_price' => $this->purchase_price * $this->total_products,
        ];

        dd($purchase_detail);

        PurchaseDetails::create($purchase_detail);

        $this->product_id = null;
        $this->purchase_price = null;
        $this->total_products = null;

        Purchase::where('id', $this->purchase_id)->update([
            'total_price' => PurchaseDetails::sum('total_price'),
        ]);
    }

    public function purchaseProses()
    {

    }

    public function updatedPurchaseCode()
    {
        $this->total_price_products = Purchase::where('id', $this->purchase_id)->first()->total_price;
    }

    public function batalkanPembelian()
    {
        Purchase::where('id', $this->purchase_id)->delete();
        $this->redirectRoute('purchase');
    }
}
