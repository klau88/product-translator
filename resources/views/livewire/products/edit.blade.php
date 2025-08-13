<div class="max-w-7xl flex flex-col justify-center p-4">
    <form class="w-full bg-white shadow-md rounded-lg p-4 sm:p-6" wire:submit.prevent="submit()">
        <h2 class="{{ $h2Style }}">Artikel aanpassen</h2>
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">
                Naam artikel
            </label>
            <input
                type="text"
                id="name"
                wire:model.defer="form.name"
                class="{{ $inputStyle }}"
                placeholder="Naam artikel"
                required
            >
            @error('name')
            <div class="mt-1 text-sm text-red-600">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">
                SKU
            </label>
            <input
                type="text"
                id="name"
                wire:model.defer="form.sku"
                class="{{ $inputStyle }}"
                placeholder="SKU"
            >
            @error('sku')
            <div class="mt-1 text-sm text-red-600">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">
                Omschrijving
            </label>
            <textarea
                id="description"
                wire:model.defer="form.description"
                rows="4"
                class="{{ $inputStyle }}"
                placeholder="Omschrijving artikel"
                required
            ></textarea>
            @error('description')
            <div class="mt-1 text-sm text-red-600">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div>
            <button type="submit" class="{{ $buttonStyle }}">Opslaan</button>
        </div>
    </form>
    <div class="w-full bg-white shadow-md rounded-lg p-4 sm:p-6">
        <div class="flex flex-row justify-between items-center">
            <h2 class="text-2xl font-bold">Vertaling(en)</h2>
            <a href="{{ route('products.add-translation', $product) }}" class="{{ $buttonStyle }}">Aanpassen</a>
        </div>

        @foreach($product->translations as $translation)
            <div class="flex flex-row justify-between items-center">
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
