<?php

namespace App\Livewire\Purchase;

use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use Illuminate\Support\Carbon;
use App\Models\PurchaseDetails;
use Livewire\Attributes\Layout;

class PurchaseIndex extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        $purchases = Purchase::orderBy('id', 'desc')->get();
        return view('livewire.purchase.purchase-index', compact('purchases'));
    }

    public function purchaseCreate()
    {
        $purchase_code = 'IN-' . time();
        Purchase::create([
            'purchase_code' => $purchase_code,
            'supplier_name' => 'Supplayer',
            'date' => Carbon::now()
        ]);

        $purchase_id = Purchase::where('purchase_code', $purchase_code)->first()->id;


        $this->redirect('purchase/create/' . $purchase_id, navigate: true);
    }

    public function purchaseDestroy($id)
    {
        // mengurangi stok produk
        $purchase_details = PurchaseDetails::where('purchase_id', $id)->get();

        // update stok barang
        foreach ($purchase_details as $key => $value) {
            $product = Product::find($value->product_id);
            if ($product) {
                $product->stock -= $value->total_products;
                $product->save();
            }
        }

        PurchaseDetails::where('purchase_id', $id)->delete();
        Purchase::find($id)->delete();
    }
}
