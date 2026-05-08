<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        // Logic to generate reports
        return view('reports.reports');
    }
}
