<div class="modal fade" id="updateCustomerModal" tabindex="-1" aria-labelledby="updateCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCustomerModalLabel">Edit Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="updateCustomerForm" method="POST" action="" class="form form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <div class="form-body">
                        <h6 class="text-primary mb-3">Informasi Pelanggan</h6>
                        <div class="row">
                            <div class="col-md-4"><label for="update_name">Nama Pelanggan</label></div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="update_name" class="form-control" name="name" required>
                            </div>

                            <div class="col-md-4"><label for="update_email">Email</label></div>
                            <div class="col-md-8 form-group">
                                <input type="email" id="update_email" class="form-control" name="email" required>
                            </div>

                            <div class="col-md-4"><label for="update_phone">Kontak</label></div>
                            <div class="col-md-8 form-group">
                                <input type="text" inputmode="numeric" onInput="this.value = this.value.replace(/[^0-9]/g, '')" id="update_phone" class="form-control" name="phone" required>
                            </div>
                        </div>

                        <hr>

                        <h6 class="text-primary mb-3 mt-4">Detail Layanan</h6>
                        <div class="row">
                            <div class="col-md-4"><label for="update_package">Paket Layanan</label></div>
                            <div class="col-md-8 form-group">
                                <select id="update_package" name="package_id" class="form-select" required>
                                    <option value="" disabled selected>Pilih paket layanan</option>
                                    <option value="1">Basic</option>
                                    <option value="2">Standard</option>
                                    <option value="3">Premium</option>
                                </select>
                            </div>

                            <div class="col-md-4"><label for="update_subscription_start_date">Tanggal Mulai Berlangganan</label></div>
                            <div class="col-md-8 form-group">
                                <input type="date" id="update_subscription_start_date" class="form-control" name="subscription_start_date" required>
                            </div>
                        </div>

                        <hr>

                        <h6 class="text-primary mb-3 mt-4">Lokasi Pelanggan</h6>
                        <div class="row">
                            <div class="col-md-4"><label for="update_address">Alamat</label></div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="update_address" class="form-control" name="address" required>
                            </div>

                            <div class="col-md-4"><label for="update_gmap_link">Link Google Maps</label></div>
                            <div class="col-md-8 form-group">
                                <input type="url" id="update_gmap_link" class="form-control" name="gmap_link">
                            </div>

                            <div class="col-md-4"><label>Koordinat (Lat & Long)</label></div>
                            <div class="col-md-8 form-group">
                                <div class="input-group mb-2">
                                    <input type="text" id="update_latitude" class="form-control" name="latitude" placeholder="Latitude">
                                    <input type="text" id="update_longitude" class="form-control" name="longitude" placeholder="Longitude">
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-info w-100" onclick="getCurrentLocation('edit')">Gunakan Lokasi Saat Ini</button>
                            </div>

                            <div class="col-md-4"><label for="update_location_photo">Foto Lokasi (Opsional)</label></div>
                            <div class="col-md-8 form-group">
                                <input type="file" id="update_location_photo" class="form-control" name="location_photo" accept="image/*">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer d-flex justify-content-end">
                <button type="button" class="btn btn-light-secondary me-1 mb-1" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="updateCustomerForm" class="btn btn-primary me-1 mb-1">Update Data</button>
            </div>
        </div>
    </div>
</div>