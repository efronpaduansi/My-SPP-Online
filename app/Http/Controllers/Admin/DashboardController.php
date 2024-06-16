<?php

namespace App\Http\Controllers\Admin;

use Agent;
use Alert;
use App\Models\Siswa;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\LevelSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $invoiceUnpaid = Invoice::where('status', 'Belum Bayar')->sum('sub_total');
        $invoicePaid = Payment::sum('amount');
        $invoiceDiscount = Invoice::sum('discount');
        $income = (Invoice::sum('sub_total') - $invoiceDiscount);

        $label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        for($bulan=1;$bulan < 13;$bulan++){
            $chartuser     = collect(DB::SELECT("SELECT count(id) AS jumlah from siswa where month(created_at)='$bulan'"))->first();
            $jumlah_user[] = $chartuser->jumlah;
        }

        //Get system information
        // Mendapatkan jenis browser yang digunakan oleh pengguna
        $browser = Agent::browser();

        // Mendapatkan versi browser yang digunakan oleh pengguna
        $browserVersion = Agent::version($browser);

        // Mendapatkan platform (sistem operasi) yang digunakan oleh pengguna
        $platform = Agent::platform();

        return view('adminpanel.pages.dashboard', compact('invoiceUnpaid', 'invoiceDiscount' ,'invoicePaid', 'income', 'label', 'jumlah_user', 'browser', 'browserVersion', 'platform'));
    }

}
