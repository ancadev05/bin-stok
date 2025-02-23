<?php

namespace App\Livewire\Purchase;

use App\Models\Sale;
use App\Models\Company;
use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use Livewire\Attributes\On;
use App\Models\SalesDetails;
use Livewire\Attributes\Title;
use App\Models\PurchaseDetails;
use Barryvdh\DomPDF\Facade\Pdf;

#[Title("Pembelian")]
class PurchaseShow extends Component
{
    public $purchase_id;

    public function mount($id)
    {
        $purchase = Purchase::find($id);
        $this->purchase_id = $purchase->id;
    }

    public function render()
    {
        $company = Company::first();
        $purchase = Purchase::find($this->purchase_id);
        $purchase_details = PurchaseDetails::where('purchase_id', $this->purchase_id)->get();

        return view('livewire.purchase.purchase-show', compact('purchase', 'purchase_details', 'company'));
    }

    // membatalkan transaksi
    #[On('destroy')]
    public function purchaseDestroy($id)
    {
        // penghapusan transaksi pending
        $purchase = Purchase::find($id)->status;
        if ($purchase == 'Selesai') {
            // kondisi jika produk sudah dijual
            $sale_details = SalesDetails::all();
            foreach ($sale_details as $key => $value) {
                $product = Product::find($value->product_id);
                if ($product) {
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

        PurchaseDetails::where('purchase_id', $this->purchase_id)->delete();
        Purchase::find($this->purchase_id)->delete();

        session()->flash('status', 'Data berhasil dihapus!');
        $this->redirectRoute('purchase', navigate: true);
    }
}
