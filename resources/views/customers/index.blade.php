@extends('app') @section('content')
    <div class="page-heading">
        <h1>Data Pelanggan</h1>
    </div>

    <div class="row" id="table-hover-spacing-row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Daftar Pelanggan</h4>
                    
                    <button type="button" class="btn btn-primary icon icon-left" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                        <i class="bi bi-plus-lg"></i> Tambah Pelanggan
                    </button>
                </div>

                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
                            <thead>
                                <tr>
                                    <th>PELANGGAN</th>
                                    <th>PAKET LAYANAN</th>
                                    <th>KONTAK & LOKASI</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td class="text-bold-500">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="rounded-circle {{ $customer->status == 'active' ? 'bg-success' : 'bg-danger' }}" 
                                                    style="width: 10px; height: 10px; display: inline-block;" 
                                                    title="{{ $customer->status == 'active' ? 'Aktif' : 'Non-Aktif' }}">
                                                </span>
                                                
                                                <div class="d-flex flex-column">
                                                    <span>{{ $customer->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="text-bold-500">
                                            <span class="badge bg-light-primary">{{ $customer->package->package ?? 'Belum ada paket' }}</span>
                                        </td>
                                        
                                        <td class="text-bold-500">
                                            @php
                                                $pesanWA = urlencode("Halo Kak {$customer->name}, saya admin dari NetBill. Ingin menginformasikan terkait layanan internetnya...");
                                            @endphp

                                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $customer->phone)) }}?text={{ $pesanWA }}" target="_blank" class="me-2" title="Hubungi via WhatsApp">
                                                <span class="badge bg-light-success">
                                                    <i class="bi-whatsapp text-success font-medium-2"></i>
                                                </span>
                                            </a>

                                            @if($customer->gmap_link)
                                                <a href="{{ $customer->gmap_link }}" target="_blank" title="Buka di Google Maps">
                                                    <span class="badge bg-light-info">
                                                        <i class="bi bi-geo-alt-fill text-info font-medium-2"></i>
                                                    </span>
                                                </a>
                                            @endif
                                        </td>
                                        
                                        <td>
                                            <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-link p-0 me-2 border-0 bg-transparent" title="Lihat Detail">
                                                <span class="badge bg-light-primary">
                                                    <i class="bi bi-eye text-primary font-medium-2"></i>
                                                </span>
                                            </a>
                                            
                                            <button class="btn btn-link p-0 me-2 border-0 bg-transparent btn-update-customer" type="button" title="Edit" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#updateCustomerModal"
                                                data-id="{{ $customer->id }}"
                                                data-name="{{ $customer->name }}"
                                                data-email="{{ $customer->email }}"
                                                data-phone="{{ $customer->phone }}"
                                                data-package="{{ $customer->package_id }}"
                                                data-date="{{ $customer->subscription_start_date }}"
                                                data-address="{{ $customer->address }}"
                                                data-gmap="{{ $customer->gmap_link }}"
                                                data-lat="{{ $customer->latitude }}"
                                                data-lng="{{ $customer->longitude }}">
                                                <span class="badge bg-light-warning">
                                                    <i class="bi bi-pencil text-warning font-medium-2"></i>
                                                </span>
                                            </button>

                                            <form method="POST" action="{{ route('customers.destroy', $customer->id) }}" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link p-0 border-0 bg-transparent" title="Hapus">
                                                    <span class="badge bg-light-danger">
                                                        <i class="bi bi-trash text-danger font-medium-2"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('customers.modal_create')
    @include('customers.modal_update')

    <script>
        function getCurrentLocation(type = 'create') {
            const prefix = type === 'edit' ? 'update_' : '';
            const latitudeInput = document.getElementById(prefix + 'latitude');
            const longitudeInput = document.getElementById(prefix + 'longitude');
            const locationStatus = document.getElementById(prefix + 'locationStatus');

            if (navigator.geolocation) {
                locationStatus.innerHTML = "<span class='text-info'>Mencari lokasi...</span>";
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        latitudeInput.value = position.coords.latitude;
                        longitudeInput.value = position.coords.longitude;
                        locationStatus.innerHTML = "<span class='text-success'>Lokasi berhasil didapatkan!</span>";
                    }, 
                    (error) => {
                        switch(error.code) {
                            case error.PERMISSION_DENIED:
                                locationStatus.innerHTML = "<span class='text-danger'>Pengguna menolak permintaan geolocation.</span>";
                                break;
                            case error.POSITION_UNAVAILABLE:
                                locationStatus.innerHTML = "<span class='text-danger'>Informasi lokasi tidak tersedia.</span>";
                                break;
                            case error.TIMEOUT:
                                locationStatus.innerHTML = "<span class='text-danger'>Permintaan lokasi time out.</span>";
                                break;
                            default:
                                locationStatus.innerHTML = "<span class='text-danger'>Terjadi kesalahan yang tidak diketahui.</span>";
                                break;
                        }
                    }
                );
            } else {
                locationStatus.innerHTML = "<span class='text-danger'>Geolocation tidak didukung oleh browser ini.</span>";
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.btn-update-customer');
            
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    
                    const form = document.getElementById('updateCustomerForm');
                    form.action = `/customers/${id}`; 
                    
                    document.getElementById('update_name').value = this.getAttribute('data-name');
                    document.getElementById('update_email').value = this.getAttribute('data-email');
                    document.getElementById('update_phone').value = this.getAttribute('data-phone');
                    document.getElementById('update_package').value = this.getAttribute('data-package');
                    document.getElementById('update_subscription_start_date').value = this.getAttribute('data-date');
                    document.getElementById('update_address').value = this.getAttribute('data-address');
                    document.getElementById('update_gmap_link').value = this.getAttribute('data-gmap');
                    document.getElementById('update_latitude').value = this.getAttribute('data-lat');
                    document.getElementById('update_longitude').value = this.getAttribute('data-lng');
                    
                    const editLocationStatus = document.getElementById('update_locationStatus');
                    if (editLocationStatus) {
                        editLocationStatus.innerHTML = "Klik tombol di atas untuk mengubah koordinat saat ini.";
                    }
                });
            });

            const urlParams = new URLSearchParams(window.location.search);
            const modalUpdateId = urlParams.get('modal_update');

            if (modalUpdateId) {
                const targetButton = document.querySelector(`.btn-update-customer[data-id="${modalUpdateId}"]`);
                if (targetButton) {
                    targetButton.click();
                }
            }
        });
    </script>
@endsection