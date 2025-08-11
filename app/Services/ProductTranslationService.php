<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Translation;
use Exception;

class ProductTranslationService
{

    /**
     * @param Product $product
     * @param string $language
     * @return array
     * @throws Exception
     */
    public function translate(Product $product, string $language): array
    {
        try {
            $locale = strtoupper(config('app.locale'));

            $translationService = app(TranslationService::class);
            $translateName = $translationService->translate($product->name, $language);
            $translateDescription = $translationService->translate($product->description, $language);

            $response = [];

            if ($translateName['detected_source_language'] === $locale && $translateName['text']) {
                $response['detected_source_language'] = $translateName['detected_source_language'];
                $response['name'] = $translateName['text'];
            }

            if ($translateDescription['detected_source_language'] === $locale && $translateDescription['text']) {
                $response['description'] = $translateDescription['text'];
            }

            $translation = Translation::updateOrCreate([
                'product_id' => $product->id,
                'language' => $language,
                'name' => $response['name'],
                'description' => $response['description'],
            ]);

            return array_merge($response, $translation->toArray());
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
