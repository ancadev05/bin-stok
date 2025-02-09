<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

#[Title("Kategori")]
class CategoryIndex extends Component
{
    // #[Layout('template-dashboard.main')]
    // #[On('status')]
    public function render()
    {
        $categories = Category::all();
        return view('livewire.category.category-index', compact('categories'));
    }

    #[On('destroy')] 
    public function destroy($id)
    {
        $product = Product::where('category_id', $id)->count();

        if ($product > 0) {

            $this->dispatch('status', text:'Kategori tidak dapat dihapus!', icon:'error', btn:'btn btn-danger');

        } else {

            Category::find($id)->delete();

            $this->dispatch('status', text:'Data berhasil dihapus!', icon:'success',  btn:'btn btn-success');
        }


        // session()->flash('status','Data berhasil dihapus!');
    }
}
