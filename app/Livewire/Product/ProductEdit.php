<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Title("Produk")]
class ProductEdit extends Component
{
    public $id;
    #[Validate('required', message:'Pilih kategori produk!')]
    public $category_id;
    public $product_code;
    #[Validate('required', message:'Isi nama produk!')]
    public $name;
    #[Validate('required', message:'Isi merek produk!')]
    public $brand;
    #[Validate('required', message:'Isi spesifikasi produk!')]
    public $specifications;
    #[Validate('required', message:'Masukkan minimal stok!')]
    public $min_stock;
    #[Validate('required', message:'Isi HPP produk!')]
    public $cost;
    #[Validate('required', message:'Isi harga jual produk!')]
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
        $this->min_stock = $produtc->min_stock;
        $this->cost = $produtc->cost;
        $this->selling_price = $produtc->selling_price;
        $this->description = $produtc->description;
    }

    public function update()
    {
        $this->validate();
        
        Product::find($this->id)->update([
            'category_id' => $this->category_id,
            'product_code' => $this->product_code,
            'name' => $this->name,
            'brand' => $this->brand,
            'specifications' => $this->specifications,
            'min_stock' => $this->min_stock,
            'cost' => $this->cost,
            'selling_price' => $this->selling_price,
            'images' => 'images.png',
            'description' => $this->description,
        ]);

        session()->flash('status','Data berhasil diubah!');
        $this->redirectRoute('product', navigate: true);
    }

    // #[Layout('template-dashboard.main')]
    public function render()
    {
        $categories = Category::all();
        return view('livewire.product.product-edit', compact('categories'));
    }
}
