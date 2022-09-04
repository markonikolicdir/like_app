<?php

namespace Tests\Unit;

use App\Models\Thread;
use App\Services\RedditService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RedditServiceTest extends TestCase
{
    private RedditService $redditService;

    public function setUp():void
    {
        parent::setUp();

        $this->redditService = new RedditService();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_publish_to_reddit()
    {
        $mock = $this->createMock(Thread::class);

        $httpTest = Http::withToken($this->redditService::TOKEN)->post($this->redditService::API, [
            'title' => $mock->title,
        ]);

        $this->assertEquals(403, $httpTest->status());

        $this->assertIsBool($this->redditService->publishToReddit($mock));
    }
}
