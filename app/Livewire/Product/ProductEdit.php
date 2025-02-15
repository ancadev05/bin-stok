<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

#[Title("Produk")]
class ProductEdit extends Component
{
    use WithFileUploads;

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
    public $unit;
    public $cost;
    #[Validate('required', message:'Isi harga jual produk!')]
    public $selling_price;
    public $images, $new_images;
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
        $this->unit = $produtc->unit;
        $this->cost = $produtc->cost;
        $this->selling_price = $produtc->selling_price;
        $this->images = $produtc->images;
        $this->description = $produtc->description;
    }

    public function update()
    {
        $this->validate();

        if ($this->new_images) {
            $this->validate(['new_images' => 'image|max:1024'], ['new_images.max' => 'Ukuran gambar maksimal 1 MB']);
            Storage::disk('public')->delete($this->images);
            $images = $this->new_images->store('product-image', 'public');
        } else {
            $images = $this->images;
        }

        Product::find($this->id)->update([
            'category_id' => $this->category_id,
            'product_code' => $this->product_code,
            'name' => $this->name,
            'brand' => $this->brand,
            'specifications' => $this->specifications,
            'min_stock' => $this->min_stock,
            'unit' => $this->unit,
            'cost' => $this->cost,
            'selling_price' => $this->selling_price,
            'images' => $images,
            'description' => $this->description,
        ]);

        session()->flash('status','Data berhasil diubah!');
        $this->redirectRoute('product', navigate: true);
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.product.product-edit', compact('categories'));
    }
}
