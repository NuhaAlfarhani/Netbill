<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Package;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with(['customer', 'package'])->get();
        return view('bills.index', compact('bills'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'month' => 'required|numeric|between:1,12',
            'year'  => 'required|numeric|digits:4'
        ]);

        $month = $request->input('month');
        $year  = $request->input('year');
        
        $targetPeriod = Carbon::create($year, $month, 1)->startOfDay();
        $periodText   = $targetPeriod->translatedFormat('F Y');
        
        $customers = Customer::where('status', 'active')
            ->where('subscription_start_date', '<=', $targetPeriod->copy()->endOfMonth())
            ->get();

        if ($customers->isEmpty()) {
            return redirect()->route('bills')->with('error', "Tidak ada pelanggan yang memenuhi syarat untuk ditagih pada periode $periodText.");
        }

        $lastBill = Bill::withTrashed()
            ->whereYear('period', $year)
            ->whereMonth('period', $month)
            ->orderBy('id', 'desc')
            ->first();

        $sequence = 1;
        if ($lastBill) {
            $parts = explode('-', $lastBill->invoice);
            $lastSequence = (int) end($parts);
            $sequence = $lastSequence + 1;
        }

        $billsCreated = 0;

        foreach ($customers as $customer) {
            $existingBill = Bill::where('customer_id', $customer->id)
                ->whereYear('period', $year)
                ->whereMonth('period', $month)
                ->first();

            if (!$existingBill) {
                $nomorInvoice = 'INV-' . $year . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);

                Bill::create([
                    'customer_id' => $customer->id,
                    'invoice'     => $nomorInvoice,
                    'package_id'  => $customer->package_id,
                    'amount'      => $customer->package->price ?? 0,
                    'status'      => 'unpaid',
                    'period'      => $targetPeriod->format('Y-m-d') 
                ]);

                $sequence++;
                $billsCreated++;
            }
        }

        if ($billsCreated > 0) {
            return redirect()->route('bills')->with('success', "Tagihan berhasil diproses untuk bulan $periodText. Total tagihan baru: $billsCreated");
        } else {
            return redirect()->route('bills')->with('info', "Semua tagihan untuk bulan $periodText sudah diproses sebelumnya.");
        }
    }

    public function pay(Bill $bill)
    {
        $bill->update(['status' => 'paid']);
        return redirect()->route('bills')->with('success', 'Tagihan berhasil dibayar.');
    }

    public function print($id)
    {
        $bill = Bill::with(['customer', 'customer.package'])->findOrFail($id);
        $pdf = Pdf::loadView('bills.invoice_pdf', compact('bill'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('invoice-' . $bill->invoice . '.pdf');
    }

    public function destroy(Bill $bill)
    {
        $bill->delete();
        return redirect()->route('bills')->with('success', 'Tagihan berhasil dihapus.');
    }
}