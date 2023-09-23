<?php

namespace App\Http\Controllers\Admin;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;
class PaymentController extends Controller
{
    public function index()
    {
        $data = Payment::latest()->get();
        return view('adminpanel.pages.payment.manage', compact('data'));
    }

    public function destroy($id)
    {
        $getPaymentData = Payment::where('id', $id)->first();

        //set Invoice status to 'Belum Bayar'
        $updateInvoiceStatus = Invoice::where('id', $getPaymentData->invoice_id)->update(array('status' => 'Belum Bayar'));
        if($updateInvoiceStatus){
            //delete payment data by ID
            $deletePaymentData = Payment::where('id', $id)->delete();
            if($deletePaymentData){
                toast('Berhasil menghapus data!','success')->timerProgressBar();
                return redirect()->back();
            }

            toast('Gagal menghapus data!','error')->timerProgressBar();
            return redirect()->back();
        }

        toast('Gagal menghapus data!','error')->timerProgressBar();
        return redirect()->back();
     
    }
}
