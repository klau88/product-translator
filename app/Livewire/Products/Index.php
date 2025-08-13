<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\ProductForm;
use App\Livewire\Traits\Messages;
use App\Livewire\Traits\Styles;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithPagination;

#[Title('Artikelen')]
class Index extends Component
{
    use WithPagination;
    use Messages;
    use Styles;

    public ProductForm $form;

    /**
     * @param Product $product
     * @return Redirector|null
     */
    public function delete(Product $product):Redirector|null
    {
        $this->form->destroy($product);
        return $this->redirectRoute('products.index', navigate: true);
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $products = Product::with('translations.language')->paginate(50);
        $locale = config('app.locale');

        return view('livewire.products.index', [
            'products' => $products,
            'buttonStyle' => $this->buttonStyle,
            'deleteButtonStyle' => $this->deleteButtonStyle,
            'confirmDelete' => $this->language[$locale]['form']['delete']['confirm'],
            'h2Style' => $this->h2Style
        ]);
    }
}
