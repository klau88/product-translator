<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use App\Models\Translation;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TranslationForm extends Form
{
    public Product $product;
    public ?Translation $translation;
    public array $languages;
    #[Validate('required')]
    public ?int $languageId;
    #[Validate('required')]
    public ?string $name;
    #[Validate('required')]
    public ?string $description;

    protected array $messages = [
        'languageId.required' => 'Taal is verplicht.',
        'name.required' => 'Naam is verplicht.',
        'description.required' => 'Omschrijving is verplicht.',
    ];

    /**
     * @return void
     */
    public function submit(): void
    {
        $this->validate();

        $translation = Translation::firstOrNew([
            'product_id' => $this->product->id,
            'language_id' => $this->languageId
        ]);

        $translation['name'] = $this->name;
        $translation['description'] = $this->description;

        if ($translation?->id) {
            $translation->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);
        } else {
            Translation::create([
                'product_id' => $this->product->id,
                'language_id' => $this->languageId,
                'name' => $this->name,
                'description' => $this->description
            ]);
        }
    }

    /**
     * @param array $languages
     * @return void
     */
    public function setLanguages(array $languages): void
    {
        $this->languages = $languages;
    }

    /**
     * @param Product $product
     * @return void
     */
    public function setProduct(Product $product): void
    {
        $this->product = Product::with('translations.language')->find($product->id);
    }

    /**
     * @param Translation $translation
     * @return void
     */
    public function setTranslation(?Translation $translation): void
    {
        if ($translation) {
            $this->languageId = $translation->language_id;
            $this->name = $translation->name;
            $this->description = $translation->description;
            $this->translation = $translation;
        } else {
            $this->languageId = null;
            $this->name = null;
            $this->description = null;
            $this->translation = null;
        }
    }

    /**
     * @param Translation $translation
     * @return void
     */
    public function destroy(Translation $translation): void
    {
        $translation->delete();
    }
}
