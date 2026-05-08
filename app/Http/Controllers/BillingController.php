<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $billing = \App\Models\BillingModel::with(['customer', 'package'])->get();
        return view('billing.billing', compact('billing'));
    }
}
