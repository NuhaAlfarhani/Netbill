<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display logs
        return view('logs.logs');
    }
}
