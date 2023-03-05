<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\{UserResource, UserCollection};

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        return new UserCollection($users);
    }

    public function show(User $user)
    {
        return new UserResource($user, true);
    }
}
