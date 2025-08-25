<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(Request $request)
{
    $query = User::where('id', '!=', auth()->id());

    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $users = $query->paginate(10);

    $suggestedUsers = User::where('id', '!=', auth()->id())
                        ->inRandomOrder()
                        ->take(5)
                        ->get();

    return view('users.index', compact('users', 'suggestedUsers'));
}

}

