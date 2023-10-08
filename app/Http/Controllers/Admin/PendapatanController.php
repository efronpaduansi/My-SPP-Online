<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
class PendapatanController extends Controller
{
    public function index()
    {
        $data = Payment::with('invoice')->orderBy('id', 'asc')->get();
        $totalPendapatan = Payment::sum('amount');
        return view('adminpanel.pages.pendapatan.index', compact('data', 'totalPendapatan'));
    }

    public function exportPDF()
    {
        $data = Payment::with('invoice')->orderBy('id', 'asc')->get();
        $totalPendapatan = Payment::sum('amount');
        $pdf = PDF::loadview('adminpanel.pages.pendapatan.export_pdf',compact('data', 'totalPendapatan'));
    	return $pdf->download('laporan-pendapatan-pdf');
    }
}
