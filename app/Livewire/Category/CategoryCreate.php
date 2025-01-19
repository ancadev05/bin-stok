<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CategoryCreate extends Component
{
    #[Validate('required', message:'Masukkan nama produk!')]
    public $name; 
    public $description;

    public function store()
    {
        $this->validate();

        // dd($this->name);

        Category::create([
            'name' => $this->name,
            'description'=> $this->description
        ]);
        
        $this->reset();

        $this->dispatch('modal-close');

    }
    public function render()
    {
        return view('livewire.category.category-create');
    }
}
