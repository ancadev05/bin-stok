<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\Attributes\Layout;

class SupplierIndex extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        return view('livewire.supplier.supplier-index', ['suppliers' => Supplier::all()]);
    }
}
