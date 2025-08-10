<?php

namespace Tests\Feature;

use App\Models\Product;
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
        $language = 'EN';
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

        $response = $this->app->make(TranslationService::class)->translate($text, $language);

        $this->assertEquals($response['detected_source_language'], $locale);
        $this->assertEquals($response['text'], $translationText);
    }

    #[Test]
    public function it_returns_an_error_message_from_api_when_language_does_not_exist(): void
    {
        $text = 'Hallo, Wereld';
        $language = 'TT';
        $url = config('services.deepl.api_url');
        $message = 'Value for \'target_lang\' not supported.';

        Http::fake([
            $url => Http::response([
                'message' => $message
            ], 400)
        ]);

        $response = $this->app->make(TranslationService::class)->translate($text, $language);

        $this->assertEquals($response['message'], $message);
    }
}
