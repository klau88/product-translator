<?php

use App\Livewire\Home;
use App\Livewire\Products\Create;
use App\Livewire\Products\Edit;
use App\Livewire\Products\Index;
use App\Livewire\Products\Show;
use App\Livewire\Products\Translate;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);

Route::prefix('products')->group(function () {
    Route::get('/', Index::class)->name('products.index');
    Route::get('/create', Create::class)->name('products.create');
    Route::get('/{product}', Show::class)->name('products.show');
    Route::get('/{product}/edit', Edit::class)->name('products.edit');
    Route::get('/{product}/add-translation', Translate::class)->name('products.add-translation');
});
