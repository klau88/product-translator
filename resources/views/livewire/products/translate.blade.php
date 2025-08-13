<div class="max-w-7xl mt-4">
    <form wire:submit="submit()">
        <h2 class="{{ $h2Style }}">Vertaling toevoegen</h2>
        <div class="mb-4">
            <label for="language" class="block text-sm font-medium text-gray-700">
                Taal
            </label>
            <select
                wire:model="form.languageId"
                wire:change="onChange"
                class="{{ $inputStyle }}"
                required
            >
                <option selected value="">Selecteer taal</option>
                @foreach($languages as $language)
                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                @endforeach
            </select>

            @error('form.languageId')
            <div class="mt-1 text-sm text-red-600">
                {{ $message }}
            </div>
            @enderror
        </div>
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
            @error('form.name')
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
                placeholder="Omschrijving"
                required
            ></textarea>
            @error('form.description')
            <div class="mt-1 text-sm text-red-600">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button class="{{ $buttonStyle }}" type="submit">Opslaan</button>
    </form>
</div>
