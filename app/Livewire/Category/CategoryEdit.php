<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Title("Kategori")]
class CategoryEdit extends Component
{
    #[Validate('required', message:'Masukkan nama produk!')]
    public $name; 
    public $description;
    public $id;

    public function mount($id)
    {
        $category = Category::find($id);
        $this->id = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
    }

    public function update()
    {
        $this->validate();

        Category::find($this->id)->update([
            'name' => $this->name,
            'description'=> $this->description
        ]);
        
        session()->flash('status','Data berhasil diubah!');
        $this->redirectRoute('category', navigate:true);
    }

    #[Layout('template-dashboard.main')]
    public function render()
    {
        return view('livewire.category.category-edit');
    }
}
