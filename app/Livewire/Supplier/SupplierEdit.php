<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class SupplierEdit extends Component
{
    public $id;
    #[Validate('required', message: 'Isi nama supplayer!')]
    public $name;
    public $address;
    public $phone_number;
    public $description;

    public function mount($id)
    {
        $suplier = Supplier::find($id);

        $this->id = $suplier->id;
        $this->name = $suplier->name;
        $this->address = $suplier->address;
        $this->phone_number = $suplier->phone_number;
        $this->description = $suplier->description;
    }

    public function update()
    {
        $this->validate();

        Supplier::find($this->id)->update([
            "name"=> $this->name,
            "address"=> $this->address,
            "phone_number"=> $this->phone_number,
            'description' => $this->description
        ]);

        $this->redirectRoute('supplier', navigate:'true');
    }

    #[Layout('template-dashboard.main')]
    public function render()
    {
        return view('livewire.supplier.supplier-edit');
    }
}
