<?php

namespace App\Livewire\Purchase;

use App\Models\Purchase;
use App\Models\PurchaseDetails;
use Livewire\Component;
use Livewire\Attributes\Layout;

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
        $purchase = Purchase::find($this->purchase_id);
        $purchase_details = PurchaseDetails::where('purchase_id', $this->purchase_id)->get();

        return view('livewire.purchase.purchase-show', compact('purchase', 'purchase_details'));
    }
}
