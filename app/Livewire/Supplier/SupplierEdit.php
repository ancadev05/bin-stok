<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use Livewire\Attributes\Layout;

class SupplierEdit extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        return view('livewire.supplier.supplier-edit');
    }
}
