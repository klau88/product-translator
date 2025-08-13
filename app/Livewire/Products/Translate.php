<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\TranslationForm;
use App\Livewire\Traits\Messages;
use App\Livewire\Traits\Styles;
use App\Models\Language;
use App\Models\Product;
use App\Models\Translation;
use App\Services\ProductTranslationService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class Translate extends Component
{
    public Product $product;
    public TranslationForm $form;
    public Collection $translations;
    public ?Translation $translation;
    use Messages;
    use Styles;

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->form->setProduct($this->product);
    }

    /**
     * @return Redirector|null
     */
    public function submit(): Redirector|null
    {
        $this->form->submit();

        return $this->redirectRoute('products.edit', $this->product, navigate: true);
    }

    /**
     * @return void
     */
    public function onChange(): void
    {
        $form = $this->form;
        $translation = $this->product->translations->filter(function ($translation) use ($form) {
            return $translation['language_id'] === $form->languageId;
        })->first();

        if ($translation) {
            $this->form->setTranslation($translation);
        } else {
            $translation = Translation::firstOrNew([
                'product_id' => $this->product->id,
                'language_id' => $this->form->languageId,
            ]);
            $this->form->setTranslation($translation);
        }
    }

    /**
     * @return void
     */
    public function translate(string $language): void
    {
        $languageId = Language::where('code', $language)->firstOrFail()->id;
        $productTranslate = app(ProductTranslationService::class)->translate($this->product, $languageId);
        $translation = Translation::find($productTranslate['id']);
        $this->form->setTranslation($translation);
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.products.translate', [
            'product' => $this->product,
            'languages' => Language::all(),
            'inputStyle' => $this->inputStyle,
            'buttonStyle' => $this->buttonStyle,
            'h2Style' => $this->h2Style,
        ]);
    }
}
