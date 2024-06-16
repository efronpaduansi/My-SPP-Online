<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Siswa;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function index()
    {
        $data = Invoice::latest()->get();
        return view('adminpanel.pages.invoice.manage', compact('data'));
    }

    public function create()
    {
        $dataSiswa = Siswa::where('status', 'active')->orderBy('name', 'asc')->get();
        $dataSemester = Semester::latest()->get();
        return view('adminpanel.pages.invoice.create', compact('dataSiswa', 'dataSemester'));
    }
    

    public function invoicePreview(Request $request)
    {
        $getDetailSiswa =  Siswa::where('id', $request->student_id)->first();
        $getDataSemester = Semester::where('id', $request->semester_id)->first();

        //hitung jumlah data kk_id yang sama dari tabel siswa
        $getKKID = Siswa::where('kk_id', $getDetailSiswa->kk_id)->count();
        
        if($getKKID > 1){
            //ambil siswa terakhir dari KK yang sama untuk mendapatkan diskon
            $getLastSiswa = Siswa::where('kk_id', $getDetailSiswa->kk_id)->orderBy('nis', 'desc')->first();
            
            //Jika $request->student_id sama dengan $getLastSiswa->id
            if($request->student_id == $getLastSiswa->id){
                $getDetailSiswa = $getLastSiswa;
               
                //cek level siswa
                if($getLastSiswa->level->level_name == 'TK'){
                    $discount = 25000;
                }else{
                    $discount = 50000;
                }

            }else{
                $getDetailSiswa =  Siswa::where('id', $request->student_id)->first();
                $discount = 0;
            }

        }else{

            $getDetailSiswa =  Siswa::where('id', $request->student_id)->first();
            $discount = 0;
        }
        
        return view('adminpanel.pages.invoice.preview', compact('getDetailSiswa', 'getDataSemester', 'discount'));
    }

    public function store(Request $request)
    {
        $data = [
            'student_id' => $request->student_id,
            'semester_id' => $request->semester_id,
            'date' => $request->date,
            'sub_total' => $request->sub_total,
            'discount' => $request->discount,
            'status' => 'Belum Bayar'
        ];

        if($request->discount_type == 1){
            $discount = (50/100) * $request->sub_total;
            $data['discount'] = $discount;
        }else{
            $data['discount'] = $request->discount;
        }

        $storeData = Invoice::create($data);
        if($storeData){
            toast('Faktur berhasil di tambahkan!','success')->timerProgressBar();
            return redirect()->route('invoice.index');
        }else{
            toast('Faktur gagal di tambahkan!','error')->timerProgressBar();
            return redirect()->route('invoice.index');
        }
    }

    //Show invoice by ID
    public function show($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        return view('adminpanel.pages.invoice.show', compact('invoice'));
    }

    //set invoice status to Lunas by ID
    public function setStatusLunas($id)
    {
        $getInvoice = Invoice::where('id', $id)->first();

        $paymentData = [
            'invoice_id' => $getInvoice->id,
            'amount' => ($getInvoice->sub_total - $getInvoice->discount ),
            'status' => 'Lunas',
            'method' => 'Cash',
            'date' => date('Y-m-d'),
            'created_by' => auth()->user()->id
        ];

        $storePaymentData = Payment::create($paymentData);
        if($storePaymentData){
            //update invoice status
            $setStatusLunas = Invoice::where('id', $id)->update(array('status' => 'Lunas'));

            toast('Faktur berhasil di ubah!','success')->timerProgressBar();
            return redirect()->route('invoice.index');
        }else{
            toast('Faktur gagal di ubah!','error')->timerProgressBar();
            return redirect()->route('invoice.index');
        }
    }

    //Edit invoice by ID
    public function edit($id)
    {
        $invoice = Invoice::where('id',$id)->first();
        return view('adminpanel.pages.invoice.edit', compact('invoice'));
    }

    //Update invoice by ID
    public function update(Request $request, $id)
    {
        $data = [
            'student_id' => $request->student_id,
            'semester_id' => $request->semester_id,
            'date' => $request->date,
            'sub_total' => $request->sub_total,
            'discount' => $request->discount,
            'status' => 'Belum Bayar'
        ];

        $updateData = Invoice::findOrFail($id)->update($data);

        if($updateData){
            toast('Faktur berhasil di ubah!','success')->timerProgressBar();
            return redirect()->route('invoice.index');
        }else{
            toast('Faktur gagal di ubah!','error')->timerProgressBar();
            return redirect()->route('invoice.index');
        }
    }

    //Delete invoice by ID
    public function destroy($id)
    {
        $delete = Invoice::findOrFail($id)->delete();

        if($delete){
            toast('Faktur berhasil di hapus!','success')->timerProgressBar();
            return redirect()->route('invoice.index');
        }else{
            toast('Faktur gagal di hapus!','error')->timerProgressBar();
            return redirect()->route('invoice.index');
        }
    }

}
