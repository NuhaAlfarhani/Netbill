<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:customers.create')->only('create', 'store');
        $this->middleware('can:customers.edit')->only('edit', 'update');
        $this->middleware('can:customers.delete')->only('destroy');
    }

    public function index()
    {
        $customers = \App\Models\CustomersModel::all();
        return view('customers.customers', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|numeric|max:20',
            'address' => 'required|string|max:255',
            'location_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gmap_link' => 'nullable|url',
            'subscription_start_date' => 'required|date',
            'package' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
        ]);

        if (CustomersModel::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => 'Email sudah terdaftar.']);
        }

        CustomersModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'location_photo' => $request->file('location_photo') ? $request->file('location_photo')->store('customer_photos', 'public') : null,
            'gmap_link' => $request->gmap_link,
            'subscription_start_date' => $request->subscription_start_date,
            'package' => $request->package,
            'status' => $request->status,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);
    
        return redirect()->route('customers')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $customer = CustomersModel::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = CustomersModel::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|numeric|max:20',
            'address' => 'required|string|max:255',
            'location_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gmap_link' => 'nullable|url',
            'subscription_start_date' => 'required|date',
            'package' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
        ]);

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'location_photo' => $request->file('location_photo') ? $request->file('location_photo')->store('customer_photos', 'public') : $customer->location_photo,
            'gmap_link' => $request->gmap_link,
            'subscription_start_date' => $request->subscription_start_date,
            'package' => $request->package,
            'status' => $request->status,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        return redirect()->route('customers')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $customer = CustomersModel::findOrFail($id);
        $customer->delete();
        return redirect()->route('customers')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
