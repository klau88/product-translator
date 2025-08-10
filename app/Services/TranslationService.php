<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class TranslationService
{
    /**
     * @param string $text
     * @param string $language
     * @return array
     * @throws ConnectionException
     */
    public function translate(string $text, string $language): array
    {
        try {
            $locale = strtoupper(config('app.locale'));

            $response = Http::withHeaders([
                'Authorization' => 'DeepL-Auth-Key ' . config('services.deepl.api_key'),
            ])->asForm()->post(config('services.deepl.api_url'), [
                'text' => $text,
                'target_lang' => $language,
            ]);

            if ($response->successful() && $response->json('translations.0.detected_source_language') === $locale) {
                return [
                    'detected_source_language' => $response->json('translations.0.detected_source_language'),
                    'text' => $response->json('translations.0.text')
                ];
            }

            return [
                'message' => $response['message']
            ];
        } catch (ConnectionException $exception) {
            throw new ConnectionException($exception->getMessage());
        }
    }
}
