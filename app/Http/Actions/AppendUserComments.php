<?php

namespace App\Http\Actions;

use App\Models\User;

class AppendUserComments
{
    public function execute(int $id, string $comments)
    {
        $user = User::findOrFail($id);
        $user->comments .= (!empty($user->comments) ? '\n' : '').$comments;
        $user->save();
    }
}
