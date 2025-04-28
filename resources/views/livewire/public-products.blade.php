<div class="bg-blue-500 h-[100vh]">
    @if ($products->isEmpty())
        <div class="min-h-screen flex items-center justify-center">
            <div class="bg-white rounded-xl shadow p-4 flex flex-col items-center text-center">
                <h2 class="text-lg font-semibold">No hay productos disponibles</h2>
            </div>
        </div>
    @else
        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($products as $product)
                <div class="bg-white rounded-xl shadow p-4 flex flex-col items-center">
                    @if ($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name ?? $product->description }}" class="w-32 h-32 object-cover mb-2 rounded">
                    @endif
                    <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600">${{ number_format($product->price, 2) }}</p>
                    <button wire:click="showDetails({{ $product->id }})"
                            class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Ver detalles
                    </button>
                </div>
            @endforeach
        </div>
        <div class="container mx-auto fixed bottom-4 left-0 right-0">
            {{ $products->links() }}
        </div>
    @endif
  
    <div  x-data="{ open: false }"
         x-show="open"
         x-on:open-modal.window="open = true"
         x-on:keydown.escape.window="open = false"
         style="display: none;"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

        <div @click.away="open = false" class="bg-white p-6 rounded-lg max-w-lg w-full">
            @if ($selectedProduct)
                <h2 class="text-xl font-bold mb-2">{{ $selectedProduct->name }}</h2>
                <p><strong>Categoría:</strong> {{ $selectedProduct->category->name }}</p>
                <p><strong>Descripción:</strong> {!! $selectedProduct->description !!}</p>
                <p><strong>Stock:</strong> {{ $selectedProduct->stock }}</p>
            @endif
            <button @click="open = false"
                    class="mt-4 px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                Cerrar
            </button>
        </div>
    </div>
</div>
