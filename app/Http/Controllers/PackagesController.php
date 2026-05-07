<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function index()
    {
        $packages = \App\Models\PackagesModel::all();
        return view('packages.packages', compact('packages'));
    }
}
