<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = \App\Models\RolesModel::all();
        return view('roles.roles', compact('roles'));
    }
}
