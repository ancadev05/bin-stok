<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Title("Supplayer")]
class SupplierCreate extends Component
{
    #[Validate('required', message: 'Isi nama supplayer!')]
    public $name;
    #[Validate('required', message: 'Isi alamat supplayer!')]
    public $address;
    #[Validate('required', message: 'Isi no telepon supplayer!')]
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

        session()->flash('status','Data berhasil ditambahkan!');
        $this->redirectRoute('supplier', navigate:'true');
    }

    public function saveNew()
    {
        $this->validate();

        Supplier::create([
            "name"=> $this->name,
            "address"=> $this->address,
            "phone_number"=> $this->phone_number,
            'description' => $this->description
        ]);

        session()->flash('status','Data berhasil ditambahkan!');
        $this->redirectRoute('supplier.create', navigate:'true');
    }
    // #[Layout('template-dashboard.main')]
    public function render()
    {
        return view('livewire.supplier.supplier-create');
    }
}
