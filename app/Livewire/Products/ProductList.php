<?php

namespace App\Livewire\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductList extends Component
{
    use WithFileUploads;

    public $products;
    public $productId;
    public $code, $name, $quantity, $price, $description, $image;
    public $isEdit = false;

    public function mount()
    {
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $this->products = Product::where('user_id', auth()->id())->latest()->get();
    }

    public function resetForm()
    {
        $this->reset(['code', 'name', 'quantity', 'price', 'description', 'image', 'productId', 'isEdit']);
    }

    public function save()
    {
        $this->validate([
            'code' => 'required|string|max:50|unique:products,code,' . $this->productId,
            'name' => 'required|string|max:250',
            'quantity' => 'required|integer|min:1|max:10000',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => $this->isEdit ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
        }

        Product::updateOrCreate(
            ['id' => $this->productId],
            [
                'user_id' => auth()->id(),
                'code' => $this->code,
                'name' => $this->name,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'description' => $this->description,
                'image' => $imagePath ?? Product::find($this->productId)?->image,
            ]
        );

        session()->flash('success', $this->isEdit ? 'Product updated!' : 'Product added!');

        $this->resetForm();
        $this->loadProducts();
    }

    public function edit($id)
    {
        $product = Product::where('user_id', auth()->id())->findOrFail($id);
        $this->productId = $product->id;
        $this->code = $product->code;
        $this->name = $product->name;
        $this->quantity = $product->quantity;
        $this->price = $product->price;
        $this->description = $product->description;
        $this->isEdit = true;
    }

    public function delete($id)
    {
        Product::where('user_id', auth()->id())->findOrFail($id)->delete();
        session()->flash('success', 'Product deleted!');
        $this->loadProducts();
    }

    public function render()
    {
        return view('livewire.products.product-list')->extends('layouts.app')->section('content');
    }
}
