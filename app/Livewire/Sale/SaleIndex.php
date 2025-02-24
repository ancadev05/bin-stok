<?php

namespace App\Livewire\Sale;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use Livewire\Attributes\On;
use App\Models\SalesDetails;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

#[Title("Penjualan")]
class SaleIndex extends Component
{
    // #[Layout('template-dashboard.main')]
    public function render()
    {
        // menghapus transaksi yang pending/batal
        $sale_id = Sale::where('status', '=', 'Pending')->latest()->first();
        if ($sale_id != null) {
            SalesDetails::where('sale_id', $sale_id->id)->delete();
            Sale::find($sale_id->id)->delete();
        }
        
        $today = date('Y-m-d');
        $sales = Sale::where('date', $today)->orderBy('id', 'desc')->get();;
        return view('livewire.sale.sale-index', compact('sales'));
    }

    public function saleCreate()
    {
        $sale_code = $this->saleCode();
        Sale::create([
            'user_id' => Auth::user()->id,
            'sale_code' => $sale_code,
            'costumer' => 'User',
            'date' => Carbon::now()
        ]);

        $sale_id = Sale::where('sale_code', $sale_code)->first()->id;

        $this->redirect('sale/create/' . $sale_id, navigate: true);
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

        $this->dispatch('success', text:'Data berhasil dihapus!');
    }

    public function saleCode()
    {
        $sale_code = time();
        return $sale_code;
    }
}
