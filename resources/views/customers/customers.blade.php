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
                        <div class="card-header">
                            <h4 class="card-title">Hoverable rows</h4>
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
        @endsection
    </body>
</html>