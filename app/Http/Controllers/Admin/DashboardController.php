<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Siswa;
use App\Models\LevelSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $label = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        for($bulan=1;$bulan < 13;$bulan++){
            $chartuser     = collect(DB::SELECT("SELECT count(id) AS jumlah from siswa where month(created_at)='$bulan'"))->first();
            $jumlah_user[] = $chartuser->jumlah;
        }
        return view('adminpanel.pages.dashboard', compact('label', 'jumlah_user'));
    }

}
