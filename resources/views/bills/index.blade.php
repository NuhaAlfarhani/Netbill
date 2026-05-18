@extends('app')@section('content')
    <div class="page-heading">
        <h1>Billing</h1>
    </div>

    <div class="card">
        <div class="card-body">
            // Filter berdasarkan nama pelanggan, status pembayaran, atau bulan tagihan
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Cari berdasarkan nama pelanggan">
                </div>
                <div class="col-md-4">
                    <select class="form-control">
                        <option value="">Pilih Status Pembayaran</option>
                        <option value="paid">Lunas</option>
                        <option value="unpaid">Belum Lunas</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control">
                        <option value="">Pilih Bulan Tagihan</option>
                        <option value="january">Januari</option>
                        <option value="february">Februari</option>
                        <option value="march">Maret</option>
                        <option value="april">April</option>
                        <option value="may">Mei</option>
                        <option value="june">Juni</option>
                        <option value="july">Juli</option>
                        <option value="august">Agustus</option>
                        <option value="september">September</option>
                        <option value="october">Oktober</option>
                        <option value="november">November</option>
                        <option value="december">Desember</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            
        </div>
    </div>
@endsection