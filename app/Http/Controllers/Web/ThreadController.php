<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Thread;

class ThreadController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('thread.index', [
            'threads' => Thread::all()
        ]);
    }

    public function nested(): Factory|View|Application
    {
        return view('thread.nested', [
            'threads' => Thread::all()
        ]);
    }
}
