<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class CategoryCreate extends Component
{
    #[Validate('required', message:'Isi nama kategori!')]
    public $name; 
    public $description;

    public function store()
    {
        $this->validate();

        Category::create([
            'name' => $this->name,
            'description'=> $this->description
        ]);
        
        session()->flash('status','Data berhasil ditambahkan!');
        $this->redirectRoute('category', navigate:true);
    }
    #[Layout('template-dashboard.main')]
    public function render()
    {
        return view('livewire.category.category-create');
    }
}
