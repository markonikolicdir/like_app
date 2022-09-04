<?php

namespace App\Services;

use App\Models\Thread;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RedditService
{
    const API = 'https://ssl.reddit.com/api/submit';

    const TOKEN = '2205412522874-6Zl5gFwjXGgXyfMnS_gMHHMbLbsByg';

    public function publishToReddit(Thread $thread): bool
    {
        $response = Http::withToken(self::TOKEN)->post(self::API, [
            'title' => $thread->title,
        ]);

        if($response->status() != Response::HTTP_CREATED) {
            Log::error('Problem with reddit api', ['error' => $response->body()]);
            return false;
        }

        return true;
    }
}
