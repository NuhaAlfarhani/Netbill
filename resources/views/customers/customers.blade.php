<!DOCTYPE html>
<html lang="en">
    <body>
        @extends('app')

        @section('content')
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
                            <div class="card-body">
                                <p>Add <code class="highlighter-rouge">.table-hover</code> to enable a hover state on table
                                    rows
                                    within a
                                    <code class="highlighter-rouge">&lt;tbody&gt;</code>.
                                </p>
                            </div>

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
                                                <td class="text-bold-500">{{ $customer->name }}</td>
                                                <td class="text-bold-500">{{ $customer->package }}</td>
                                                <td class="text-bold-500">
                                                    <a href="#" class="me-2" title="Hubungi via WhatsApp">
                                                        <span class="badge bg-light-success">
                                                            <i class="bi-whatsapp text-success font-medium-2"></i>
                                                        </span>
                                                    </a>

                                                    <a href="#" title="Buka di Google Maps">
                                                        <span class="badge bg-light-primary">
                                                            <i class="bi bi-geo-alt-fill text-primary font-medium-2"></i>
                                                        </span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="#" class="me-2" title="Detail">
                                                        <span class="badge bg-light-info">
                                                            <i class="bi bi-eye text-info font-medium-2"></i>
                                                        </span>
                                                    </a>

                                                    <a href="#" class="me-2" title="Edit">
                                                        <span class="badge bg-light-info">
                                                            <i class="bi bi-pencil text-warning font-medium-2"></i>
                                                        </span>
                                                    </a>

                                                    <from method="POST" action="#" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="button p-0 border-0 bg-transparent" title="Hapus">
                                                            <span class="badge bg-light-danger">
                                                                <i class="bi bi-trash text-danger font-medium-2"></i>
                                                            </span>
                                                        </button>
                                                    </from>
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

            <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCustomerModalLabel">Tambah Pelanggan Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <form id="addCustomerForm" method="POST" action="{{ route('customers.store') }}" class="form form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <h6 class="text-primary mb-3">Informasi Pelanggan</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="name">Nama Pelanggan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="name" class="form-control" name="name" placeholder="Masukkan nama pelanggan" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" id="email" class="form-control" name="email" placeholder="Masukkan email pelanggan" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="phone">Kontak</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" inputmode="numeric" onInput="this.value = this.value.replace(/[^0-9]/g, '')" id="phone" class="form-control" name="phone" placeholder="Masukkan nomor kontak (WhatsApp)" required>
                                        </div>
                                    </div>

                                    <hr>

                                    <h6 class="text-primary mb-3 mt-4">Detail Layanan</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="package">Paket Layanan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <select id="package" name="package" class="form-select" required>
                                                <option value="" disabled selected>Pilih paket layanan</option>
                                                <option value="1">Basic</option>
                                                <option value="2">Standard</option>
                                                <option value="3">Premium</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="subscription_start_date">Tanggal Mulai Berlangganan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" id="subscription_start_date" class="form-control" name="subscription_start_date" required>
                                        </div>
                                    </div>

                                    <hr>

                                    <h6 class="text-primary mb-3 mt-4">Lokasi Pelanggan</h6>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="address">Alamat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="address" class="form-control" name="address" placeholder="Masukkan alamat lokasi pelanggan" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="gmap_link">Link Google Maps</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="url" id="gmap_link" class="form-control" name="gmap_link" placeholder="Masukkan link Google Maps">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Koordinat (Latitude & Longitude)</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <div class="input-group mb-2">
                                                <input type="text" id="latitude" class="form-control" name="latitude" placeholder="Latitude">
                                                <input type="text" id="longitude" class="form-control" name="longitude" placeholder="Longitude">
                                            </div>

                                            <button type="button" class="btn btn-sm btn-outline-info w-100" onclick="getCurrentLocation()">Gunakan Lokasi Saat Ini</button>
                                            
                                            <small class="text-muted d-block mt-1" id="locationStatus">Klik tombol di atas untuk mengisi koordinat dengan lokasi Anda saat ini.</small>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="location_photo">Foto Lokasi</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="file" id="location_photo" class="form-control" name="location_photo" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer d-flex justify-content-end">
                            <button type="button" class="btn btn-light-secondary me-1 mb-1" data-bs-dismiss="modal">Batal</button>
                            <button type="reset" form="addCustomerForm" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            <button type="submit" form="addCustomerForm" class="btn btn-primary me-1 mb-1">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        @endsection

        <script>
            function getCurrentLocation() {
                const locationStatus = document.getElementById('locationStatus');
                const latitudeInput = document.getElementById('latitude');
                const longitudeInput = document.getElementById('longitude');

                if (navigator.geolocation) {
                    locationStatus.innerHTML = 'mencari lokasi...';
                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                } else {
                    locationStatus.innerHTML = 'Geolocation tidak didukung oleh browser ini.';
                }

                function showPosition(position) {
                    latitudeInput.value = position.coords.latitude;
                    longitudeInput.value = position.coords.longitude;
                    locationStatus.innerHTML = "<span class='text-success'>Lokasi berhasil didapatkan!</span>";
                }

                function showError(error) {
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
            }
        </script>
    </body>
</html>