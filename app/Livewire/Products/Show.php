<?php

namespace App\Livewire\Products;

use App\Enums\Language;
use App\Livewire\Forms\ProductForm;
use App\Livewire\Traits\Messages;
use App\Livewire\Traits\Styles;
use App\Models\Product;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

#[Title('Toon artikel')]
class Show extends Component
{
    use Messages;
    use Styles;

    public Product $product;
    public ProductForm $form;
    public array $languages;
    public Collection $translations;

    /**
     * @param Product $product
     * @return Redirector|null
     */
    public function delete(Product $product): Redirector|null
    {
        $this->form->destroy($product);
        return $this->redirectRoute('products.index', navigate: true);
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->languages = collect(Language::cases())->filter(fn($language) => $language->value !== strtoupper(config('app.locale')))->values()->toArray();
        $this->translations = Translation::where('product_id', $this->product->id)->get();
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $locale = config('app.locale');

        return view('livewire.products.show', [
            'buttonStyle' => $this->buttonStyle,
            'confirmDelete' => $this->language[$locale]['form']['delete']['confirm']
        ]);
    }
}
