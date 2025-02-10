<?php

namespace App\Livewire\Purchase;

use App\Models\Company;
use Livewire\Component;
use App\Models\Purchase;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use App\Models\PurchaseDetails;

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
    public function purchaseUndo()
    {
        PurchaseDetails::where('purchase_id', $this->purchase_id)->delete();
        Purchase::find($this->purchase_id)->delete();

        session()->flash('status','Data berhasil dihapus!');
        $this->redirectRoute('report-purchase', navigate: true);
    }
}
