<?php

namespace Modules\SectionComponent\Services;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class OpenAiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . config('services.openai.key'),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function generateHTML($prompt)
    {
        try {
            $response = $this->client->post('engines/davinci/completions', [
                'json' => [
                    'prompt' => $prompt,
                    'max_tokens' => 150,
                ],
            ]);
            $data = json_decode($response->getBody(), true);
//            dd($data);
            return $data['choices'][0]['text'] ?? '';
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle the exception as you see fit
            // For example, you could log the error and return a user-friendly message
            Log::error("Error connecting to OpenAI: " . $e->getMessage());
            return "An error occurred while generating content.";
        }



    }
}
