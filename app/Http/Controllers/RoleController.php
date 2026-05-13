<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = \App\Models\Role::all();
        return view('roles.roles', compact('roles'));
    }
}
