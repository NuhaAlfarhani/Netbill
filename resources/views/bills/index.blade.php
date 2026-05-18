@extends('app')

@section('content')
    <div class="page-heading d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Data Tagihan Pelanggan</h3>
        
        <button type="button" class="btn btn-primary icon icon-left shadow-sm" data-bs-toggle="modal" data-bs-target="#addBillModal">
            <i class="bi bi-plus-lg"></i> Buat Invoice Manual
        </button>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('bills') }}" method="GET" id="filterForm">
                <div class="row g-3">
                    
                    <div class="col-12 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="bi bi-search text-muted d-flex"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Ketik nama & tekan Enter..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="bi bi-funnel text-muted d-flex"></i>
                            </span>
                            <select name="status" class="form-select border-start-0 ps-0" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                                <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Belum Lunas</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="bi bi-calendar3 text-muted d-flex"></i>
                            </span>
                            <select name="month" class="form-select border-start-0 ps-0" onchange="this.form.submit()">
                                <option value="">Semua Bulan</option>
                                <option value="january" {{ request('month') == 'january' ? 'selected' : '' }}>Januari</option>
                                <option value="february" {{ request('month') == 'february' ? 'selected' : '' }}>Februari</option>
                                <option value="march" {{ request('month') == 'march' ? 'selected' : '' }}>Maret</option>
                                <option value="april" {{ request('month') == 'april' ? 'selected' : '' }}>April</option>
                                <option value="may" {{ request('month') == 'may' ? 'selected' : '' }}>Mei</option>
                                <option value="june" {{ request('month') == 'june' ? 'selected' : '' }}>Juni</option>
                                <option value="july" {{ request('month') == 'july' ? 'selected' : '' }}>Juli</option>
                                <option value="august" {{ request('month') == 'august' ? 'selected' : '' }}>Agustus</option>
                                <option value="september" {{ request('month') == 'september' ? 'selected' : '' }}>September</option>
                                <option value="october" {{ request('month') == 'october' ? 'selected' : '' }}>Oktober</option>
                                <option value="november" {{ request('month') == 'november' ? 'selected' : '' }}>November</option>
                                <option value="december" {{ request('month') == 'december' ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-lg">
                    <thead>
                        <tr>
                            <th>INVOICE</th>
                            <th>PELANGGAN</th>
                            <th>PERIODE</th>
                            <th>TAGIHAN</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($bills as $bill)
                            <tr>
                                <td class="text-bold-500">
                                    <span class="text-primary fw-bold">#{{ $bill->invoice_number ?? 'INV-'.$bill->id }}</span>
                                </td>
                                
                                <td class="text-bold-500">
                                    {{ $bill->customer->name ?? 'Pelanggan Dihapus' }}<br>
                                    <small class="text-muted">{{ $bill->customer->phone ?? '' }}</small>
                                </td>
                                
                                <td class="text-bold-500">
                                    {{ \Carbon\Carbon::parse($bill->billing_date ?? $bill->created_at)->translatedFormat('F Y') }}
                                </td>
                                
                                <td class="text-bold-500">
                                    Rp{{ number_format($bill->amount ?? 0, 0, ',', '.') }}
                                </td>
                                
                                <td class="text-bold-500">
                                    @if($bill->status == 'paid' || $bill->status == 'lunas')
                                        <span class="badge bg-light-success px-3 py-2">LUNAS</span>
                                    @else
                                        <span class="badge bg-light-danger px-3 py-2">BELUM BAYAR</span>
                                    @endif
                                </td>
                                
                                <td>
                                    @if($bill->status != 'paid' && $bill->status != 'lunas')
                                        <form method="POST" action="{{ route('bills.pay', $bill->id) }}" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin mengubah status tagihan ini menjadi LUNAS?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-link p-0 me-2 border-0 bg-transparent" title="Tandai Lunas">
                                                <span class="badge bg-light-success">
                                                    <i class="bi bi-check-circle-fill text-success font-medium-2"></i>
                                                </span>
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('bills.print', $bill->id) }}" target="_blank" class="btn btn-link p-0 me-2 border-0 bg-transparent" title="Cetak Invoice">
                                        <span class="badge bg-light-info">
                                            <i class="bi bi-printer-fill text-info font-medium-2"></i>
                                        </span>
                                    </a>

                                    <form method="POST" action="{{ route('bills.destroy', $bill->id) }}" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tagihan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 border-0 bg-transparent" title="Hapus">
                                            <span class="badge bg-light-danger">
                                                <i class="bi bi-trash-fill text-danger font-medium-2"></i>
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
@endsection