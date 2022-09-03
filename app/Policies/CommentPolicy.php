<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * @throws Exception
     */
    public function changeVisibility(User $user, Comment $comment): bool
    {
        $thread = $comment->getThread();

        if($user->id != $thread->getUser()->id) {
            return false;
        }
        
        return true;
    }
}
