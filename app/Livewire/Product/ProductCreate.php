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
    #[Validate('required', message: 'Pilih kategori produk!')]
    public $category_id;
    public $product_code;
    #[Validate('required', message: 'Isi nama produk!')]
    public $name;
    #[Validate('required', message: 'Isi merek produk!')]
    public $brand;
    #[Validate('required', message: 'Isi spesifikasi produk!')]
    public $specifications;
    #[Validate('required', message: 'Masukkan minimal stok!')]
    public $min_stock;
    #[Validate('required', message: 'Isi HPP produk!')]
    public $cost;
    #[Validate('required', message: 'Isi harga jual produk!')]
    public $selling_price;
    public $images;
    public $description;

    public function store()
    {
        $this->validate();

        $new_code = $this->generateProductCode();

        Product::create([
            'category_id' => $this->category_id,
            'product_code' => $new_code,
            'name' => $this->name,
            'brand' => $this->brand,
            'specifications' => $this->specifications,
            'min_stock' => $this->min_stock,
            'cost' => $this->cost,
            'selling_price' => $this->selling_price,
            'images' => 'images.png',
            'description' => $this->description,
        ]);

        session()->flash('status', 'Data berhasil ditambahkan!');
        $this->redirectRoute('product', navigate: true);
    }

    // simpan tambah baru
    public function saveNew()
    {
        $this->validate();

        // penentuan kode product
        $new_code = $this->generateProductCode();

        Product::create([
            'category_id' => $this->category_id,
            'product_code' => $new_code,
            'name' => $this->name,
            'brand' => $this->brand,
            'specifications' => $this->specifications,
            'min_stock' => $this->min_stock,
            'cost' => $this->cost,
            'selling_price' => $this->selling_price,
            'images' => 'images.png',
            'description' => $this->description,
        ]);

        session()->flash('status', 'Data berhasil ditambahkan!');
        $this->redirectRoute('product.create', navigate: true);
    }

    public function generateProductCode()
    {
        // penentuan kode product
        if ($this->product_code == null) {
            $last_product = Product::where('category_id', $this->category_id)->latest()->first();
            if ($last_product) {
                // Ambil nomor urut dari kode terakhir
                $last_code = intval(substr($last_product->product_code, -4));
                $new_code = str_pad($last_code + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $new_code = str_pad(1, 4, '0', STR_PAD_LEFT);
            }
        } else {
            $new_code = Str::upper($this->product_code);
        }

        $product_name = Str::upper(substr($this->name, 0, 1));
        $product_brand = Str::upper(substr($this->brand, 0, 1));

        $product_code = 'PC' . $this->category_id . '-' . $product_brand . $product_name . $new_code;

        return $product_code;
    }

    #[Layout('template-dashboard.main')]
    public function render()
    {
        $categories = Category::all();
        return view('livewire.product.product-create', compact('categories'));
    }
}
