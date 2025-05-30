<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $userMessage = $request->input('message');
        $conversation = $request->session()->get('conversation', []);

        // Tambahkan pesan user ke riwayat percakapan
        $conversation[] = ['role' => 'user', 'content' => $userMessage];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
            'HTTP-Referer' => 'https://www.sitename.com',
            'X-Title' => 'SiteName',
            'Content-Type' => 'application/json',
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'deepseek/deepseek-r1:free',
            'messages' => $conversation,
        ]);

        $aiResponse = $response->json()['choices'][0]['message']['content'] ?? 'No response received.';

        // Tambahkan respon AI ke riwayat percakapan
        $conversation[] = ['role' => 'assistant', 'content' => $aiResponse];
        $request->session()->put('conversation', $conversation);

        return response()->json([
            'response' => $aiResponse
        ]);
    }

    public function clearConversation(Request $request)
    {
        $request->session()->forget('conversation');
        return response()->json(['status' => 'success']);
    }
}