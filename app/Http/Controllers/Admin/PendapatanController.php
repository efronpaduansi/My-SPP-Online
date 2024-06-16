<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Payment;
use App\Models\LevelSiswa;
use Illuminate\Http\Request;
use App\Exports\PaymentTkExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentSDKelas1Export;
use App\Exports\PaymentSDKelas2Export;
use App\Exports\PaymentSDKelas3Export;
use App\Exports\PaymentSDKelas4to6Export;
use Alert;

class PendapatanController extends Controller
{
    public function index()
    {
        $data = Payment::with('invoice')->orderBy('id', 'asc')->get();
        $totalPendapatan = Payment::sum('amount');
        $levels = LevelSiswa::all();
        return view('adminpanel.pages.pendapatan.index', compact('data', 'totalPendapatan', 'levels'));
    }

    public function exportPDF()
    {
        $data = Payment::with('invoice')->orderBy('id', 'asc')->get();
        $totalPendapatan = Payment::sum('amount');
        $pdf = PDF::loadview('adminpanel.pages.pendapatan.export_pdf',compact('data', 'totalPendapatan'));
    	return $pdf->download('laporan-pendapatan-pdf');
    }


    public function exportData(Request $request)
    {   
        $level = $request->level_id;
        if($level == 1){
            return Excel::download(new PaymentTkExport, 'spp-tk.xlsx');
            return redirect()->route('pendapatan.index');
        }elseif($level == 2){
            return Excel::download(new PaymentSDKelas1Export, 'spp-sd-kelas1.xlsx');
            return redirect()->route('pendapatan.index');
        }elseif($level == 3){
            return Excel::download(new PaymentSDKelas2Export, 'spp-sd-kelas2.xlsx');
            return redirect()->route('pendapatan.index');
        }elseif($level == 4){
            return Excel::download(new PaymentSDKelas3Export, 'spp-sd-kelas3.xlsx');
            return redirect()->route('pendapatan.index');
        }elseif($level == 5){
            return Excel::download(new PaymentSDKelas4to6Export, 'spp-sd-kelas4dan6.xlsx');
            return redirect()->route('pendapatan.index');
        }else{
            toast('Gagal menambahkan data!','error')->timerProgressBar();
            return redirect()->route('pendapatan.index');
        }
        
    }

}
