<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIRecommendationService
{
    public function recommend($cartProducts, $availableProducts)
    {
        $cartNames     = collect($cartProducts)->pluck('name')->implode(', ');
        $storeProducts = collect($availableProducts)->pluck('name')->implode(', ');

        $prompt ="
                    You are a strict recommendation system for a grocery store.

                    You are given:
                    1. Customer cart items
                    2. Available store products

                    Your job:
                    - Recommend 4 complementary products
                    - Based on shopping logic (not random)
                    - Must improve basket value or usefulness

                    STRICT RULES:
                    - Use ONLY products from the available list
                    - Output EXACTLY 4 products
                    - No duplicates
                    - No explanations
                    - No extra text

                    INPUT:
                    Cart:
                    {$cartNames}

                    Products:
                    {$storeProducts}

                    OUTPUT:
                    Comma-separated product names only.;";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model'       => 'llama-3.3-70b-versatile',
            'messages'    => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'max_tokens'  => 100,
            'temperature' => 0.7,
        ]);

        $data = $response->json();

        return $data['choices'][0]['message']['content'] ?? null;
    }
}