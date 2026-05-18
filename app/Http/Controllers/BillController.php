<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with(['customer', 'package'])->get();
        return view('bills.index', compact('bills'));
    }
}
