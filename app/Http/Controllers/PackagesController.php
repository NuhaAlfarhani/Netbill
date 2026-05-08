<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackagesModel;

class PackagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:packages.create')->only('create', 'store');
        $this->middleware('can:packages.edit')->only('edit', 'update');
        $this->middleware('can:packages.delete')->only('destroy');
    }

    public function index()
    {
        $packages = PackagesModel::all();
        return view('packages.packages', compact('packages'));
    }

    public function create(Request $request)
    {
        return view('packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'package' => 'required|string|max:255',
            'speed' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        PackagesModel::create([
            'package' => $request->package,
            'speed' => $request->speed,
            'price' => $request->price,
            'description' => $request->description,
        ]);
    
        return redirect()->route('packages')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $package = PackagesModel::findOrFail($id);
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $package = PackagesModel::findOrFail($id);

        $request->validate([
            'package' => 'required|string|max:255',
            'speed' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $package->update([
            'package' => $request->package,
            'speed' => $request->speed,
            'price' => $request->price,
            'description' => $request->description,
        ]);
    
        return redirect()->route('packages')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $package = PackagesModel::findOrFail($id);
        $package->delete();
        return redirect()->route('packages')->with('success', 'Paket berhasil dihapus.');
    }
}
