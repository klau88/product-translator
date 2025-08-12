<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductForm extends Form
{
    public Product $product;
    #[Validate('required')]
    public string $name;
    public string $sku;
    #[Validate('required')]
    public string $description;

    protected array $messages = [
        'name.required' => 'Naam is verplicht.',
        'description.required' => 'Omschrijving is verplicht.',
    ];

    /**
     * @return void
     */
    public function store(): void
    {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
        ]);
    }

    /**
     * @param Product $product
     * @return void
     */
    public function setProduct(Product $product): void
    {
        $this->name = $product->name;
        $this->sku = $product->sku;
        $this->description = $product->description;
        $this->product = $product;
    }

    /**
     * @return void
     */
    public function update(): void
    {
        $this->validate();

        $this->product->update([
            'name' => $this->name,
            'sku' => $this->sku,
            'description' => $this->description,
        ]);
    }

    /**
     * @param Product $product
     * @return void
     */
    public function destroy(Product $product): void
    {
        $product->delete();
    }
}
