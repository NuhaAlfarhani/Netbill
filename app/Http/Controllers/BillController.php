<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $billing = \App\Models\Bill::with(['customer', 'package'])->get();
        return view('billing.billing', compact('billing'));
    }
}
