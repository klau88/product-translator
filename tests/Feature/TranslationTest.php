<?php

namespace Tests\Feature;

use App\Models\Language;
use App\Models\Product;
use App\Services\ProductTranslationService;
use App\Services\TranslationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TranslationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function it_can_translate_a_text_to_english(): void
    {
        $text = 'Hallo, Wereld';
        $locale = strtoupper(config('app.locale'));
        $languageCode = 'EN';
        $translationText = 'Hello, World';
        $url = config('services.deepl.api_url');

        Http::fake([
            $url => Http::response([
                'translations' => [
                    [
                        'detected_source_language' => $locale,
                        'text' => $translationText
                    ]
                ]
            ], 200)
        ]);

        $response = $this->app->make(TranslationService::class)->translate($text, $languageCode);

        $this->assertEquals($response['detected_source_language'], $locale);
        $this->assertEquals($response['text'], $translationText);
    }

    #[Test]
    public function it_returns_an_error_message_from_api_when_language_does_not_exist(): void
    {
        $text = 'Hallo, Wereld';
        $languageCode = 'TT';
        $url = config('services.deepl.api_url');
        $message = 'Value for \'target_lang\' not supported.';

        Http::fake([
            $url => Http::response([
                'message' => $message
            ], 400)
        ]);

        $response = $this->app->make(TranslationService::class)->translate($text, $languageCode);

        $this->assertEquals($response['message'], $message);
    }

    #[Test]
    public function it_can_translate_a_product_to_english_and_save_it(): void
    {
        $locale = strtoupper(config('app.locale'));
        $language = Language::where(['code' => 'EN'])->first();

        $product = Product::factory()->create([
            'name' => 'Blauwe pen',
            'description' => 'Een blauwe pen om je handtekening mee te zetten',
        ]);

        $this->mock(TranslationService::class, function ($mock) use ($product, $locale, $language) {
            $language = Language::find($language->id);

            $mock->shouldReceive('translate')
                ->with($product->name, $language->code)
                ->andReturn([
                    'detected_source_language' => $locale,
                    'text' => 'Blue pen'
                ]);

            $mock->shouldReceive('translate')
                ->with($product->description, $language->code)
                ->andReturn([
                    'detected_source_language' => $locale,
                    'text' => 'A blue pen to write your signature with'
                ]);
        });

        $response = $this->app->make(ProductTranslationService::class)->translate($product, $language->id);

        $this->assertEquals($response['detected_source_language'], $locale);
        $this->assertEquals($response['product_id'], $product->id);
        $this->assertEquals($response['name'], 'Blue pen');
        $this->assertEquals($response['description'], 'A blue pen to write your signature with');
    }
}
