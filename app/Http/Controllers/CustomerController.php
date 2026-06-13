<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        // Bonus Tip: Gunakan with('package') agar query ke database jauh lebih cepat (Eager Loading)
        $customers = Customer::with('package')->get();
        return view('customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::with('package')->findOrFail($id);
        return view('customers.show', compact('customer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|numeric|max_digits:20',
            'address' => 'required|string|max:255',
            'location_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gmap_link' => 'nullable|url',
            'subscription_start_date' => 'required|date',
            'package_id' => 'required|exists:packages,id',
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'location_photo' => $request->file('location_photo') ? $request->file('location_photo')->store('customer_photos', 'public') : null,
            'gmap_link' => $request->gmap_link,
            'subscription_start_date' => $request->subscription_start_date,
            'package_id' => $request->package_id,
            // Kolom status tidak perlu ditulis karena akan otomatis diisi 'active' oleh database
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        return redirect()->route('customers')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|numeric|max_digits:20', // Diperbaiki jadi max_digits
            'address' => 'required|string|max:255',
            'location_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gmap_link' => 'nullable|url',
            'subscription_start_date' => 'required|date',
            'package_id' => 'required|exists:packages,id',
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
            'package_id' => $request->package_id,
            'status' => $request->status,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        return redirect()->route('customers')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customers')->with('success', 'Pelanggan berhasil dihapus.');
    }
}