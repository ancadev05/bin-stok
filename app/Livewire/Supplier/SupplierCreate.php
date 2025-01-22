<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class SupplierCreate extends Component
{
    #[Validate('required', message: 'Isi nama supplayer!')]
    public $name;
    public $address;
    public $phone_number;
    public $description;

    public function store()
    {
        $this->validate();

        Supplier::create([
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
        return view('livewire.supplier.supplier-create');
    }
}
