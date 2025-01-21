<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

class CategoryIndex extends Component
{
    #[Layout('template-dashboard.main')]
    // #[On('modal-close')]
    public function render()
    {
        $categories = Category::all();
        return view('livewire.category.category-index', compact('categories'));
    }
}
