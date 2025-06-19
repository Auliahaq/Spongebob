<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function ask(Request $request)
    {
        $question = $request->input('question');

        // Validasi input
        if (!$question) {
            return response()->json(['answer' => 'Pertanyaan kosong.'], 400);
        }

        try {
            $apiKey = env('GEMINI_API_KEY');
            $prompt = 'Jawablah dengan gaya yang mudah dimengerti: ' . $question;

            $response = Http::withOptions([
                'verify' => 'D:\XAMPP\php\extras\ssl\cacert.pem'
            ])->withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key={$apiKey}", [
                'contents' => [[
                    'parts' => [[ 'text' => $prompt ]]
                ]]
            ]);

            if ($response->failed()) {
                return response()->json([
                    'answer' => '⚠️ Gagal dari Gemini: ' . $response->body()
                ], 500);
            }

            $data = $response->json();
            $answer = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if ($answer && trim($answer) !== '') {
                return response()->json(['answer' => $answer]);
            } else {
                return response()->json(['answer' => '⚠️ Jawaban kosong dari AI.'], 500);
            }

        } catch (\Exception $e) {
            return response()->json([
                'answer' => '⚠️ Internal Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
