@extends('app')

@section('content')

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-info-circle me-2"></i> {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="page-heading d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Data Tagihan Pelanggan</h3>
        
        <!-- DROPDOWN BUAT TAGIHAN MANUAL DISINI -->
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
                                    <span class="text-primary fw-bold">#{{ $bill->invoice ?? 'INV-'.$bill->id }}</span>
                                </td>
                                
                                <td class="text-bold-500">
                                    {{ $bill->customer->name ?? 'Pelanggan Dihapus' }}<br>
                                    <small class="text-muted">{{ $bill->customer->phone ?? '' }}</small>
                                </td>
                                
                                <td class="text-bold-500">
                                    {{ \Carbon\Carbon::parse($bill->billing_date ?? $bill->created_at)->translatedFormat('F Y') }}
                                </td>
                                
                                <td class="text-bold-500">
                                    Rp{{ number_format($bill->package->price ?? 0, 0, ',', '.') }}
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
                                            @method('PUT')
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