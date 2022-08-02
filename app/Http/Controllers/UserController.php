<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(StoreUserRequest $request){
        $data = $request->validated();
        $user = User::create($data);
        return redirect()->route('all_users');
    }
}
