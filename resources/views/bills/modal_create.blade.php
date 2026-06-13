<div class="modal fade" id="addBillModal" tabindex="-1" aria-labelledby="addBillModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="dropdown d-inline-block">
                <button class="btn btn-primary icon icon-left shadow-sm dropdown-toggle" type="button" id="dropdownManualBill" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                    <i class="bi bi-plus-lg"></i> Buat Tagihan Baru
                </button>
                
                <div class="dropdown-menu dropdown-menu-end p-4 shadow-lg border-0" aria-labelledby="dropdownManualBill" style="width: 320px; border-radius: 12px;">
                    <h6 class="text-uppercase fw-bold mb-4" style="font-size: 0.85rem; letter-spacing: 0.5px; color: #1e293b;">Pilih Periode</h6>
                    
                    <form action="{{ route('bills.generate') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label text-sm text-muted">Bulan</label>
                            <select name="month" class="form-select bg-light border-0" required>
                                @php $currentMonth = date('n'); @endphp
                                <option value="1" {{ $currentMonth == 1 ? 'selected' : '' }}>Januari</option>
                                <option value="2" {{ $currentMonth == 2 ? 'selected' : '' }}>Februari</option>
                                <option value="3" {{ $currentMonth == 3 ? 'selected' : '' }}>Maret</option>
                                <option value="4" {{ $currentMonth == 4 ? 'selected' : '' }}>April</option>
                                <option value="5" {{ $currentMonth == 5 ? 'selected' : '' }}>Mei</option>
                                <option value="6" {{ $currentMonth == 6 ? 'selected' : '' }}>Juni</option>
                                <option value="7" {{ $currentMonth == 7 ? 'selected' : '' }}>Juli</option>
                                <option value="8" {{ $currentMonth == 8 ? 'selected' : '' }}>Agustus</option>
                                <option value="9" {{ $currentMonth == 9 ? 'selected' : '' }}>September</option>
                                <option value="10" {{ $currentMonth == 10 ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ $currentMonth == 11 ? 'selected' : '' }}>November</option>
                                <option value="12" {{ $currentMonth == 12 ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label text-sm text-muted">Tahun</label>
                            <select name="year" class="form-select bg-light border-0" required>
                                @php $currentYear = date('Y'); @endphp
                                <option value="{{ $currentYear - 1 }}">{{ $currentYear - 1 }}</option>
                                <option value="{{ $currentYear }}" selected>{{ $currentYear }}</option>
                                <option value="{{ $currentYear + 1 }}">{{ $currentYear + 1 }}</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Proses Sekarang</button>
                    </form>
                </div>
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
                
                <form id="addBillForm" method="POST" action="{{ route('bills.store') }}" class="form form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <h6 class="text-primary mb-3">Informasi Tagihan</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Invoice</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="name" class="form-control" name="name" required>
                            </div>

                            <div class="col-md-4">
                                <label for="customer">Pelanggan</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="customer" class="form-control" name="customer" placeholder="Masukkan nama pelanggan" required>
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