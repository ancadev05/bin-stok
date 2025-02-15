<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title("Supplayer")]
class SupplierIndex extends Component
{
    // #[Layout('template-dashboard.main')]
    public function render()
    {
        return view('livewire.supplier.supplier-index', ['suppliers' => Supplier::all()]);
    }

    #[On('destroy')]
    public function destroy($id)
    {
        Supplier::find($id)->delete();
        $this->dispatch('success', text:'Data berhasil dihapus!');
    }
}
