<?php

namespace App\Livewire\Report;

use App\Models\Purchase;
use Livewire\Component;
use Livewire\Attributes\Layout;

class PurchaseReport extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        $purchases = Purchase::all();
        return view('livewire.report.purchase-report', compact('purchases'));
    }
}
