<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): Response|bool
    {
        return true;
    }

    public function view(User $user, Thread $thread): Response|bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Thread $thread): bool
    {
        if($user->id != $thread->getUser()->id) {
            return false;
        }

        if(Carbon::now()->gt($thread->created_at->addHours(6))) {
            return false;
        }

        return true;
    }

    public function delete(User $user, Thread $thread): bool
    {
        return true;
    }
}
