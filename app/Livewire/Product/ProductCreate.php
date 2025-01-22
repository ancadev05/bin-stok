<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

class ProductCreate extends Component
{
    #[Validate('required', message:'Pilih kategori produk!')]
    public $category_id;
    public $product_code;
    #[Validate('required', message:'Isi nama produk!')]
    public $name;
    #[Validate('required', message:'Isi merek produk!')]
    public $brand;
    #[Validate('required', message:'Isi spesifikasi produk!')]
    public $specifications;
    #[Validate('required', message:'Isi HPP produk!')]
    public $cost;
    #[Validate('required', message:'Isi harga jual produk!')]
    public $selling_price;
    public $images;
    public $description;

    public function store()
    {
        $this->validate();
        
        // penentuan kode product
        if ($this->product_code == null) {
            $product_code = Str::upper( 'PRD-' . $this->category_id . '-' . time());
        } else {
            $product_code = Str::upper( $this->product_code);
        }

        Product::create([
            'category_id' => $this->category_id,
            'product_code' => $product_code,
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
        return view('livewire.product.product-create', compact('categories'));
    }
}
