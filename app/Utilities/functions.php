<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class functions
{
    public static function getListProvince()
    {
        $provinces = Storage::disk('public')->get('provinces.json');

        return json_decode($provinces, true);
    }

    public static function getProvinceName($id)
    {
        $data = self::getListProvince();
        $province = collect($data)->where('code', '=', $id)->first();
        if ($province['division_type'] == 'thành phố trung ương') {
            return Str::remove('Thành phố ', $province['name']);
        }

        return $province['name'];
    }

    public static function embedByCohere($text)
    {
        $response = Http::withHeaders(
            ['accept' => 'application/json',
                'content-type' => 'application/json',
                'Authorization' => 'bearer '.env('COHERE_API_KEY')]
        )->timeout(60)->withOptions(['verify' => false])->post('https://api.cohere.com/v2/embed',
            [
                'model' => 'embed-v4.0',
                'texts' => [$text],
                'input_type' => 'search_document',
            ]);

        if (isset($response['embeddings']['float'][0])) {
            return $response['embeddings']['float'][0];
        } else {
            return null;
        }
    }

    public static function cosineSimilarity($vector1, $vector2)
    {
        $sigmaSum = 0;

        foreach ($vector1 as $i => $value) {
            $sigmaSum += $value * $vector2[$i];
        }

        $sigmaSqrtA = 0;
        foreach ($vector1 as $i => $value) {
            $sigmaSqrtA += $value ** 2;
        }

        $sigmaSqrtB = 0;
        foreach ($vector2 as $i => $value) {
            $sigmaSqrtB += $value ** 2;
        }

        return $sigmaSum / (sqrt($sigmaSqrtA) * sqrt($sigmaSqrtB));
    }
}
