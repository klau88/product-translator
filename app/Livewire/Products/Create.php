<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\ProductForm;
use App\Livewire\Traits\Styles;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

#[Title('Nieuw artikel')]
class Create extends Component
{
    use Styles;

    public ProductForm $form;

    /**
     * @return Redirector|null
     */
    public function submit(): Redirector|null
    {
        $this->form->store();

        return $this->redirectRoute('products.index', navigate: true);
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $errorStyle = 'mt-1 text-sm text-red-600';

        return view('livewire.products.create', [
            'inputStyle' => $this->inputStyle,
            'errorStyle' => $errorStyle,
            'buttonStyle' => $this->buttonStyle
        ]);
    }
}
