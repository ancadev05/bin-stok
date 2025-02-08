<?php

namespace App\Livewire\Purchase;

use App\Models\Company;
use Livewire\Component;
use App\Models\Purchase;
use Livewire\Attributes\Title;
use App\Models\PurchaseDetails;
use Livewire\Attributes\Layout;

#[Title("Pembelian")]
class PurchaseShow extends Component
{
    public $purchase_id;

    public function mount($id)
    {
        $purchase = Purchase::find($id);
        $this->purchase_id = $purchase->id;
    }

    #[Layout('template-dashboard.main')]
    public function render()
    {
        $company = Company::first();
        $purchase = Purchase::find($this->purchase_id);
        $purchase_details = PurchaseDetails::where('purchase_id', $this->purchase_id)->get();

        return view('livewire.purchase.purchase-show', compact('purchase', 'purchase_details', 'company'));
    }
}
