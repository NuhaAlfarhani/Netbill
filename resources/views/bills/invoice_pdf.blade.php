<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Invoice - {{ $bill->invoice }}</title>
        <style>
            /* Reset & Font */
            body {
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                color: #333;
                font-size: 14px;
                line-height: 1.5;
                margin: 0;
                padding: 20px;
            }

            /* Layout Helpers */
            table { width: 100%; border-collapse: collapse; }
            .text-right { text-align: right; }
            .text-left { text-align: left; }
            .text-center { text-align: center; }
            .fw-bold { font-weight: bold; }
            
            /* Header Section */
            .header-table { margin-bottom: 40px; }
            .company-name { font-size: 24px; font-weight: bold; color: #435ebe; letter-spacing: 1px; }
            .invoice-title { font-size: 32px; font-weight: bold; color: #e9ecef; letter-spacing: 2px; text-transform: uppercase; }
            
            /* Info Section */
            .info-table { margin-bottom: 40px; }
            .info-title { font-size: 12px; color: #6c757d; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
            
            /* Status Badges */
            .status-badge { 
                display: inline-block; 
                padding: 5px 12px; 
                border-radius: 4px; 
                font-size: 12px; 
                font-weight: bold; 
                text-transform: uppercase;
            }
            .status-paid { background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; }
            .status-unpaid { background-color: #f8d7da; color: #842029; border: 1px solid #f5c2c7; }

            /* Items Table */
            .items-table { border: 1px solid #dee2e6; margin-bottom: 30px; }
            .items-table th { 
                background-color: #f8f9fa; 
                color: #495057; 
                padding: 12px; 
                border-bottom: 2px solid #dee2e6; 
                text-transform: uppercase; 
                font-size: 12px;
            }
            .items-table td { padding: 12px; border-bottom: 1px solid #dee2e6; }
            .total-row td { font-size: 16px; background-color: #f8f9fa; border-top: 2px solid #435ebe; }

            /* Footer */
            .footer { margin-top: 50px; font-size: 12px; color: #6c757d; text-align: center; border-top: 1px solid #eee; padding-top: 20px; }
        </style>
    </head>

    <body>
        <table class="header-table">
            <tr>
                <td class="text-left">
                    <div class="company-name">NetBill.</div>
                    <div style="color: #6c757d; font-size: 13px; margin-top: 5px;">
                        Jl. Ngagel Rejo, Surabaya<br>
                        Jawa Timur, Indonesia<br>
                        WhatsApp: +62 812-XXXX-XXXX
                    </div>
                </td>
                <td class="text-right" style="vertical-align: top;">
                    
                    @if($bill->status == 'paid' || $bill->status == 'lunas')
                        <div class="invoice-title" style="color: #198754;">OFFICIAL RECEIPT</div>
                    @else
                        <div class="invoice-title">INVOICE</div>
                    @endif
                    <div style="margin-top: 10px;">
                        @if($bill->status == 'paid' || $bill->status == 'lunas')
                            <span class="status-badge status-paid">Lunas</span>
                        @else
                            <span class="status-badge status-unpaid">Belum Bayar</span>
                        @endif
                    </div>
                </td>
            </tr>
        </table>

        <table class="info-table">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <div class="info-title">Ditagihkan Kepada:</div>
                    <div class="fw-bold" style="font-size: 16px; margin-bottom: 3px;">{{ $bill->customer->name }}</div>
                    <div style="color: #495057;">
                        {{ $bill->customer->phone }}<br>
                        {{ $bill->customer->address ?? 'Alamat tidak tersedia' }}
                    </div>
                </td>
                
                <td style="width: 50%; vertical-align: top;" class="text-right">
                    <table style="width: 100%;">
                        <tr>
                            <td class="info-title" style="padding-bottom: 5px;">Nomor Invoice:</td>
                            <td class="fw-bold" style="padding-bottom: 5px;">{{ $bill->invoice ?? 'INV-'.$bill->id }}</td>
                        </tr>
                        <tr>
                            <td class="info-title" style="padding-bottom: 5px;">Tanggal Terbit:</td>
                            <td class="fw-bold" style="padding-bottom: 5px;">{{ \Carbon\Carbon::parse($bill->created_at)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <td class="info-title">Periode Tagihan:</td>
                            <td class="fw-bold" style="color: #435ebe;">{{ \Carbon\Carbon::parse($bill->period)->translatedFormat('F Y') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th class="text-left" style="width: 5%;">No</th>
                    <th class="text-left" style="width: 55%;">Deskripsi Layanan</th>
                    <th class="text-center" style="width: 15%;">Periode</th>
                    <th class="text-right" style="width: 25%;">Jumlah</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>
                        <div class="fw-bold">Layanan Internet Broadband</div>
                        <div style="font-size: 12px; color: #6c757d; margin-top: 3px;">
                            Paket: {{ $bill->customer->package->name ?? 'Paket Standar' }}
                        </div>
                    </td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($bill->period)->translatedFormat('M Y') }}</td>
                    <td class="text-right">Rp{{ number_format($bill->amount, 0, ',', '.') }}</td>
                </tr>
                <tr class="total-row fw-bold">
                    <td colspan="3" class="text-right" style="padding: 15px;">TOTAL TAGIHAN</td>
                    <td class="text-right" style="padding: 15px; color: #435ebe;">Rp{{ number_format($bill->amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        @if($bill->status != 'paid' && $bill->status != 'lunas')
            <div>
                <div class="info-title">Instruksi Pembayaran</div>
                <p style="font-size: 13px; color: #495057; margin-top: 5px; line-height: 1.6;">
                    Harap melakukan pembayaran tepat waktu sebelum jatuh tempo untuk menghindari pemutusan layanan. Pembayaran dapat ditransfer melalui rekening di bawah ini:<br>
                    <strong>BCA:</strong> 123-456-7890 (a.n. NetBill Internet)<br>
                    <strong>Mandiri:</strong> 098-765-4321 (a.n. NetBill Internet)
                </p>
            </div>
        @else
            <div style="background-color: #f8f9fa; border-left: 4px solid #198754; padding: 15px;">
                <div class="info-title" style="color: #198754;">Status Pembayaran</div>
                <p style="font-size: 14px; font-weight: bold; color: #198754; margin: 5px 0 0 0;">
                    ✓ TELAH DIBAYAR LUNAS
                </p>
                <p style="font-size: 12px; color: #6c757d; margin: 5px 0 0 0;">
                    Terima kasih atas pembayaran Anda. Bukti ini sah diterbitkan oleh sistem NetBill.
                </p>
            </div>
        @endif

        <div class="footer">
            <p>Terima kasih telah menggunakan layanan NetBill.</p>
            <p style="font-style: italic;">Dokumen ini dibuat secara otomatis oleh sistem dan sah tanpa tanda tangan basah.</p>
        </div>
    </body>
</html>