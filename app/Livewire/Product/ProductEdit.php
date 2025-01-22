<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Layout;

class ProductEdit extends Component
{
    public $id;
    public $category_id;
    public $product_code;
    public $name;
    public $brand;
    public $specifications;
    public $cost;
    public $selling_price;
    public $images;
    public $description;

    public function mount($id)
    {
        $produtc = Product::find($id);

        $this->id = $produtc->id;
        $this->category_id = $produtc->category_id;
        $this->product_code = $produtc->product_code;
        $this->name = $produtc->name;
        $this->brand = $produtc->brand;
        $this->specifications = $produtc->specifications;
        $this->cost = $produtc->cost;
        $this->selling_price = $produtc->selling_price;
        $this->description = $produtc->description;
    }

    public function update()
    {
        Product::find($this->id)->update([
            'category_id' => $this->category_id,
            'product_code' => $this->product_code,
            'name' => $this->name,
            'brand' => $this->brand,
            'specifications' => $this->specifications,
            'cost' => $this->cost,
            'selling_price' => $this->selling_price,
            'images' => 'images.png',
            'description' => $this->description,
        ]);

        $this->redirectRoute('product', navigate: true);
    }

    #[Layout('template-dashboard.main')]
    public function render()
    {
        $categories = Category::all();
        return view('livewire.product.product-edit', compact('categories'));
    }
}
