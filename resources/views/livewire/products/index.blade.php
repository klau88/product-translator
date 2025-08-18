<div class="flex flex-col">
    <div class="my-4 flex flex-row justify-between items-center">
        <h2 class="{{ $h2Style }}">Artikelen</h2>
        <a wire:navigate
           class="{{ $buttonStyle }}"
           href="{{ route('products.create') }}"
        >Nieuw artikel</a>
    </div>
    <table class="table-auto">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr wire:key="{{ $product->id }}">
                <td class="py-2">{{ $product->name }}</td>
                <td class="py-2">{{ str($product->description)->words(20) }}</td>
                <td class="py-2">
                    <div class="flex flex-row items-center">
                        <a wire:navigate
                           class="{{ $buttonStyle }}"
                           href="{{ route('products.show', $product) }}"
                        >Bekijk</a>
                        <button
                            class="{{ $deleteButtonStyle }}"
                            wire:click="delete({{ $product }})"
                            wire:confirm="{{ $confirmDelete }}"
                            type="button">Verwijder
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
