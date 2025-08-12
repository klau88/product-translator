<?php

namespace App\Livewire\Products;

use App\Enums\Language;
use App\Livewire\Forms\ProductForm;
use App\Livewire\Traits\Styles;
use App\Models\Product;
use App\Models\Translation;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

#[Title('Wijzig artikel')]
class Edit extends Component
{
    use Styles;

    public Product $product;
    public ProductForm $form;
    public array $languages;
    public Collection $translations;

    /**
     * @return Redirector|null
     */
    public function submit(): Redirector|null
    {
        $this->form->update();

        return $this->redirectRoute('products.show', $this->product, navigate: true);
    }

    /**
     * @return void
     */
    public function mount(): void
    {
        $this->form->setProduct($this->product);
        $this->languages = collect(Language::cases())->filter(fn($language) => $language->value !== strtoupper(config('app.locale')))->values()->toArray();
        $this->translations = Translation::where('product_id', $this->product->id)->get();
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $errorStyle = 'mt-1 text-sm text-red-600';

        return view('livewire.products.edit', [
            'inputStyle' => $this->inputStyle,
            'errorStyle' => $errorStyle,
            'buttonStyle' => $this->buttonStyle
        ]);
    }
}
