@extends('app')

@section('content')
    <h1>Paket Data</h1>
    <p>Daftar paket data yang tersedia untuk pelanggan.</p>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama Paket</th>
                    <th>Kecepatan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                    <tr>
                        <td>{{ $package->package }}</td>
                        <td>{{ $package->speed }} Mbps</td>
                        <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection