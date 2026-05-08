<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = \App\Models\UsersModel::all();
        return view('users.users', compact('users'));
    }
}
