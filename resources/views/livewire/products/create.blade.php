<div class="flex justify-center mt-4">
    <form class="w-full max-w-7xl bg-white shadow-md rounded-lg p-4 sm:p-6" wire:submit="submit()">
        <h2 class="text-xl sm:text-2xl font-bold  py-2 text-left rounded-md">Nieuw artikel</h2>
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
</div>


