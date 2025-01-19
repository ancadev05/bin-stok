<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class CategoryIndex extends Component
{
    public function render()
    {
        $categories = Category::all();
        return view('livewire.category.category-index', compact('categories'));
    }
}
