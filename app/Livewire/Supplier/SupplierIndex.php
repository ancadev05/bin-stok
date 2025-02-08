<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
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

    public function destroy($id)
    {
        Supplier::find($id)->delete();
        session()->flash('status','Data berhasil dihapus!');
    }
}
