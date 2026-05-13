<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCustomerModalLabel">Tambah Pelanggan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <p class="fw-bold mb-1">Duh, ada yang salah nih:</p>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
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
                                <select id="package" name="package_id" class="form-select" required>
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