@extends('app') @section('content')
    <div class="page-heading d-flex align-items-center">
        <a href="{{ route('customers') }}" class="btn btn-light-secondary me-3 icon icon-left">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div>
            <h3 class="mb-0">Profil Pelanggan</h3>
            <p class="text-subtitle text-muted mb-0">Detail informasi langganan dan lokasi.</p>
        </div>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-12 col-lg-8">
                
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl bg-primary me-3 d-flex justify-content-center align-items-center rounded" style="width: 70px; height: 70px;">
                                    <span class="text-white fs-2 fw-bold">{{ strtoupper(substr($customer->name, 0, 1)) }}</span>
                                </div>
                                <div>
                                    <h4 class="mb-1">{{ $customer->name }}</h4>
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-calendar3 me-1"></i> Member sejak: {{ \Carbon\Carbon::parse($customer->subscription_start_date)->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>
                            <div>
                                @if($customer->status == 'active')
                                    <span class="badge bg-light-success px-3 py-2">AKTIF</span>
                                @else
                                    <span class="badge bg-light-danger px-3 py-2">NON-AKTIF</span>
                                @endif
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 border rounded">
                                    <span class="text-muted text-uppercase font-bold" style="font-size: 0.75rem;">
                                        <i class="bi bi-telephone me-1"></i> Kontak
                                    </span>
                                    <h6 class="mt-2 mb-1">{{ $customer->phone }}</h6>
                                    @php
                                        $pesanWA = urlencode("Halo Kak {$customer->name}, saya admin dari NetBill. Ingin menginformasikan terkait layanan internetnya...");
                                    @endphp
                                    <a href="https://wa.me/{{ preg_replace ('/^0/', '62', preg_replace('/[^0-9]/', '', $customer->phone)) }}?text={{ $pesanWA }}" target="_blank" class="text-success text-sm fw-bold">
                                        Chat WhatsApp &rarr;
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 border rounded h-100">
                                    <span class="text-muted text-uppercase font-bold" style="font-size: 0.75rem;">
                                        <i class="bi bi-geo-alt me-1"></i> Alamat
                                    </span>
                                    <h6 class="mt-2 mb-0" style="line-height: 1.5;">{{ $customer->address }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm bg-primary text-white mb-4">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-white-50 text-uppercase font-bold" style="font-size: 0.75rem;">Paket Berlangganan</span>
                            <h3 class="text-white mt-1 mb-1">{{ $customer->package->package ?? 'Belum ada paket' }}</h3>
                            <span class="badge bg-white text-primary">Up to {{ $customer->package->speed ?? '??' }} Mbps</span>
                        </div>
                        <div class="text-end">
                            <span class="text-white-50 text-uppercase font-bold" style="font-size: 0.75rem;">Tagihan Bulanan</span>
                            <h2 class="text-white mt-1 mb-0">
                                Rp{{ number_format($customer->package->price ?? 0, 0, ',', '.') }}
                            </h2>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('customers', ['modal_update' => $customer->id]) }}" class="btn btn-outline-primary w-100 p-3 fw-bold shadow-sm">
                    <i class="bi bi-pencil-square me-2"></i> Kembali ke Tabel untuk Edit Data
                </a>

            </div>

            <div class="col-12 col-lg-4">
                
                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center pb-2">
                        <h6 class="mb-0 text-uppercase font-bold">Foto Lokasi</h6>
                        <i class="bi bi-image text-muted"></i>
                    </div>
                    <div class="card-body">
                        @if($customer->location_photo)
                            <img src="{{ asset('storage/' . $customer->location_photo) }}" alt="Foto Rumah" class="img-fluid rounded w-100 object-fit-cover" style="max-height: 250px;">
                        @else
                            <div class="rounded d-flex flex-column justify-content-center align-items-center gap-2" style="height: 200px; border: 2px dashed var(--bs-gray-500); background-color: transparent">
                                <i class="bi bi-image text-muted fs-1 mb-2" style="font-size: 3.5 rem; line-height: 1"></i>
                                <span class="text-secondary fw-bold mt-2">Foto belum diupload</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center pb-2">
                        <h6 class="mb-0 text-uppercase font-bold">Navigasi</h6>
                        <i class="bi bi-geo-alt text-muted"></i>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-light-primary mb-3 text-center">
                            @if($customer->gmap_link || ($customer->latitude && $customer->longitude))
                                <span class="text-primary"><i class="bi bi-check-circle me-1"></i> Koordinat lokasi tersedia.</span>
                            @else
                                <span class="text-danger"><i class="bi bi-x-circle me-1"></i> Data lokasi belum lengkap.</span>
                            @endif
                        </div>

                        @if($customer->gmap_link)
                            <a href="{{ $customer->gmap_link }}" target="_blank" class="btn btn-primary w-100">
                                <i class="bi bi-box-arrow-up-right me-2"></i> Buka Google Maps
                            </a>
                        @elseif($customer->latitude && $customer->longitude)
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $customer->latitude }},{{ $customer->longitude }}" target="_blank" class="btn btn-primary w-100">
                                <i class="bi bi-geo-alt-fill me-2"></i> Arahkan Rute
                            </a>
                        @else
                            <button class="btn btn-secondary w-100" disabled>Lokasi Tidak Tersedia</button>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection