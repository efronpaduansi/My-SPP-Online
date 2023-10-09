<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Payment;
use App\Models\LevelSiswa;
use Illuminate\Http\Request;
use App\Exports\PaymentTkExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

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
            return Excel::download(new PaymentTkExport, 'pembayaran-tk.xlsx');
            return redirect()->route('pendapatan.index');
        }else{
            dd('Bukan TK');
        }
        
    }

}
