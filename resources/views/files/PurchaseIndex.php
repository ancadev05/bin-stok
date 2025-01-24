<?php

namespace App\Livewire\Purchase;

use livewire;
use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;

class PurchaseIndex extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        $purchases = Purchase::all();

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
        Purchase::find($id)->delete();
    }
}
