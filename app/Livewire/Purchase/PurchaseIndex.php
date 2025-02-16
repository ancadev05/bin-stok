<?php

namespace App\Livewire\Purchase;

use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use App\Models\PurchaseDetails;
use App\Models\SalesDetails;

#[Title("Pembelian")]
class PurchaseIndex extends Component
{
    // #[Layout('template-dashboard.main')]
    public function render()
    {
        // menghapus transaksi yang pending/batal
        $purchase_id = Purchase::where('discount_price', '=', 0)->latest()->first();
        if ($purchase_id != null) {
            PurchaseDetails::where('purchase_id', $purchase_id->id)->delete();
            Purchase::find($purchase_id->id)->delete();
        }

        $today = date('Y-m-d');
        $purchases = Purchase::where('date', $today)->orderBy('id', 'desc')->get();
        return view('livewire.purchase.purchase-index', compact('purchases'));
    }

    public function purchaseCreate()
    {

        $purchase_code = $this->purchaseCode();
        Purchase::create([
            'purchase_code' => $purchase_code,
            'supplier_name' => 'Supplayer',
            'date' => Carbon::now()
        ]);

        $purchase_id = Purchase::where('purchase_code', $purchase_code)->first()->id;

        $this->redirect('purchase/create/' . $purchase_id, navigate: true);
    }

    #[On('destroy')]
    public function purchaseDestroy($id)
    {
        $purchase = Purchase::find($id)->status;
        
        // penghapusan transaksi pending
        if ($purchase == 'Selesai') {
            // kondisi jika produk sudah dijual
            $sale_details = SalesDetails::all();
            foreach ($sale_details as $key => $value) {
                $product = Product::find($value->product_id);
                if($product)
                {
                    return $this->dispatch('failed', text: 'Transaksi, tidak bisa dihapus. Cek transaksi penjualan!');
                }
            }

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
        }

        PurchaseDetails::where('purchase_id', $id)->delete();
        Purchase::find($id)->delete();

        $this->dispatch('success', text:'Data berhasil dihapus!');
    }

    public function purchaseCode()
    {
        $date = date('Y-m-d');
        $last_purchase_code = Purchase::where('date', $date)->latest()->first();

        if ($last_purchase_code) {
            $last_code = intval(substr($last_purchase_code->purchase_code, -4));
            $new_code = str_pad($last_code + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $new_code = str_pad(1, 4, '0', STR_PAD_LEFT);
        }

        $purchase_code = 'IN-' . date('d') . date('m') . '/' . $new_code;

        return $purchase_code;
    }
}
