<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use Livewire\Attributes\Layout;

class SupplierCreate extends Component
{
    #[Layout('template-dashboard.main')]
    public function render()
    {
        return view('livewire.supplier.supplier-create');
    }
}
