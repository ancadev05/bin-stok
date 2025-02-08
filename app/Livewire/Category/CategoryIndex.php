<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

#[Title("Kategori")]
class CategoryIndex extends Component
{
    // #[Layout('template-dashboard.main')]
    // #[On('modal-close')]
    public function render()
    {
        $categories = Category::all();
        return view('livewire.category.category-index', compact('categories'));
    }

    public function destroy($id)
    {
        Category::find($id)->delete();

        session()->flash('status','Data berhasil dihapus!');
    }
}
