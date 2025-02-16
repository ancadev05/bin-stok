<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use App\Models\Company;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\SalesDetails;
use Livewire\Attributes\Title;

#[Title("Penjualan")]
class SaleShow extends Component
{
    public $sale_id;

    public function mount($id)
    {
        $sale = Sale::find($id);
        $this->sale_id = $sale->id;
    }

    public function render()
    {
        $company = Company::first();
        $sale = Sale::find($this->sale_id);
        $sale_details = SalesDetails::where('sale_id', $this->sale_id)->get();

        return view('livewire.sale.sale-show', compact('company', 'sale', 'sale_details'));
    }

    #[On('destroy')]
    public function saleDestroy($id)
    {
        // penghapusan transaksi pending
        $sale = Sale::find($id)->status;
        if ($sale == 'Selesai') {
            // mengurangi stok produk
            $sale_details = SalesDetails::where('sale_id', $id)->get();

            // update stok barang
            foreach ($sale_details as $key => $value) {
                $product = Product::find($value->product_id);
                if ($product) {
                    $product->stock += $value->total_products;
                    $product->save();
                }
            }
        }

        SalesDetails::where('sale_id', $id)->delete();
        Sale::find($id)->delete();

        session()->flash('status','Data berhasil dihapus!');
        $this->redirectRoute('sale', navigate: true);
    }
}
