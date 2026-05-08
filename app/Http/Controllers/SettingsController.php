<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = \App\Models\SettingsModel::all();
        return view('settings.settings', compact('settings'));
    }
}
