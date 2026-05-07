<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = \App\Models\CustomersModel::all();
        return view('customers.customers', compact('customers'));
    }
}
