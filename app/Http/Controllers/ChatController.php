<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $userMessage = $request->input('message');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
            'HTTP-Referer' => 'https://www.sitename.com',
            'X-Title' => 'SiteName',
            'Content-Type' => 'application/json',
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'deepseek/deepseek-r1:free',
            'messages' => [
                ['role' => 'user', 'content' => $userMessage],
            ],
        ]);

        return response()->json([
            'response' => $response->json()['choices'][0]['message']['content'] ?? 'No response received.'
        ]);
    }
}
