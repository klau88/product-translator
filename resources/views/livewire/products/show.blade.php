<div class="max-w-7xl mt-4">
    <div class="mt-4">
        <div class="flex flex-col justify-between">
            <div class="flex flex-row justify-between items-center">
                <h2 class="{{ $h2Style }}">{{ $product->name }}</h2>
                <div class="flex flex-row justify-between items-center">
                    <a href="{{ route('products.edit', $product) }}"
                       class="{{ $buttonStyle }}"
                    >
                        Bewerken
                    </a>
                    <button
                        class="{{ $deleteButtonStyle }}"
                        type="button"
                        wire:click="delete({{$product}})"
                        wire:confirm="{{ $confirmDelete }}"
                    >
                        Verwijder
                    </button>
                </div>
            </div>
            <div class="my-2">
                <span class="block text-sm font-medium text-gray-700">SKU</span>
                <span class="block mt-1 text-gray-900">{{ $product->sku }}</span>
            </div>
            <div class="my-2">
                <span class="block text-sm font-medium text-gray-700">Omschrijving</span>
                <p class="mt-1 text-gray-900">{{ $product->description }}</p>
            </div>
        </div>
        <div class="mt-8">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold  py-2 text-left rounded-md">Vertaling(en)</h2>
            </div>

            @foreach($product->translations as $translation)
                <div class="flex flex-row items-center">
                    <div class="p-2 w-1/6">
                        <h3 class="text-xl font-bold">{{ $translation->language->name }}</h3>
                    </div>
                    <div class="w-5/6 flex justify-between items-center">
                        <div class="p-2">
                            <div>
                                Naam: {{ $translation->name }}
                            </div>
                            <div>
                                Omschrijving: {{ $translation->description }}
                            </div>
                        </div>
                        <button type="button"
                                class="{{ $deleteButtonStyle }}"
                                wire:click="deleteTranslation({{ $translation }})"
                                wire:confirm="{{ $confirmDelete }}"
                        >
                            Verwijderen
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
