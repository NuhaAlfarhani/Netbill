<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MikrotikController extends Controller
{
    public function index()
    {
        // Logic to connect to Mikrotik and retrieve data
        return view('mikrotik.mikrotik');
    }
}
