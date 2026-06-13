@extends('app')

@section('content')
    <style>
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-8px); /* Angka negatif bikin card naik ke atas */
            box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important; /* Memperbesar bayangan */
        }
    </style>

    <div class="page-heading d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
        <div class="mb-3 mb-md-0">
            <h3 class="mb-1">Paket Internet</h3>
            <p class="text-muted text-sm mb-0">Atur layanan dan harga berlangganan.</p>
        </div>
        
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-info shadow-sm icon icon-left fw-bold">
                <i class="bi bi-arrow-repeat"></i> Sync Router
            </button>
            
            <button type="button" class="btn btn-secondary shadow-sm icon icon-left fw-bold">
                <i class="bi bi-printer"></i> Cetak Price List
            </button>
            
            <button type="button" class="btn btn-primary shadow-sm icon icon-left fw-bold" data-bs-toggle="modal" data-bs-target="#addPackageModal">
                <i class="bi bi-plus-lg"></i> Buat Paket Baru
            </button>
        </div>
    </div>

    <div class="row">
        @forelse($packages as $package)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0 hover-lift" style="border-radius: 16px;">
                    <div class="card-body p-4 d-flex flex-column">
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="avatar avatar-lg bg-light-primary" style="border-radius: 12px;">
                                <span class="avatar-content"><i class="bi bi-lightning-charge-fill text-primary" style="font-size: 1.2rem;"></i></span>
                            </div>
                            <span class="badge bg-primary px-3 py-2" style="border-radius: 20px; font-size: 0.8rem;">
                                {{ $package->speed }} Mbps
                            </span>
                        </div>

                        <h5 class="card-title fw-bold mb-1">{{ $package->package }}</h5>
                        <p class="text-muted small mb-4">Limit: {{ $package->speed }}M/{{ $package->speed }}M</p>

                        <div class="mb-4">
                            <span class="text-primary fw-bold" style="font-size: 1rem; vertical-align: top;">Rp</span>
                            
                            <span class="fw-bold" style="font-size: 2.2rem; letter-spacing: -1px; margin-left: -2px;">
                                {{ number_format($package->price, 0, ',', '.') }}
                            </span>
                            
                            <span class="text-muted small">/bln</span>
                        </div>

                        <div class="d-flex gap-2 mt-auto">
                            <button class="btn btn-light-primary w-100 fw-bold text-sm">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </button>
                            <button class="btn btn-light-danger w-100 fw-bold text-sm">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </div>
                        
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light-primary color-primary shadow-sm text-center py-4">
                    <i class="bi bi-info-circle fs-4 d-block mb-2"></i>
                    Belum ada data paket internet. Silakan tambahkan paket baru.
                </div>
            </div>
        @endforelse
    </div>
@endsection