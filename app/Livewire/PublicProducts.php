<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class PublicProducts extends Component
{
    public Product $selectedProduct;

    public function showDetails(int $id)
    {
        $this->selectedProduct = Product::with('category')->find($id);
        $this->dispatch('open-modal');
    }
    
    public function render()
    {
        return view('livewire.public-products', [
            'products' => Product::with('category')->paginate(2),
        ]);
    }
}
