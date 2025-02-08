<?php

namespace App\Livewire\Report;

use Livewire\Component;
use App\Models\Purchase;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title("Laporan")]
class PurchaseReport extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        $purchases = Purchase::all();
        return view('livewire.report.purchase-report', compact('purchases'));
    }
}
