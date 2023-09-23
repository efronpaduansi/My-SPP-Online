<?php

namespace App\Http\Controllers\Admin;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;
class TahunAjaranController extends Controller
{
    public function index()
    {
        $data = TahunAjaran::latest()->get();
        return view('adminpanel.pages.tahun_ajaran.manage', compact('data'));
    }

    public function store(Request $request)
    {
        $data = [
            'ta_name' => $request->ta_name,
        ];

        $storeData = TahunAjaran::create($data);

        if($storeData){
            toast('Berhasil menambahkan data!','success')->timerProgressBar();
            return redirect()->back();
        }else{
            toast('Gagal menambahkan data!','error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $updateData = [
            'ta_name' => $request->ta_name,
        ];

        $updated = TahunAjaran::findOrFail($id)->update($updateData);

        if($updated){
            toast('Berhasil mengubah data!','success')->timerProgressBar();
            return redirect()->back();
        }else{
            toast('Gagal mengubah data!','error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $delete = TahunAjaran::findOrFail($id)->delete();

        if($delete){
            toast('Berhasil menghapus data!','success')->timerProgressBar();
            return redirect()->back();
        }else{
            toast('Gagal menghapus data!','error')->timerProgressBar();
            return redirect()->back();
        }
    }
}
