<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class FollowController extends Controller
{
    public function toggle(User $user)
    {
        $currentUser = auth()->user();

        if ($currentUser->following()->where('following_id', $user->id)->exists()) {
            $currentUser->following()->detach($user->id);
        } else {
            $currentUser->following()->attach($user->id);
        }

        return back();
    }
}

