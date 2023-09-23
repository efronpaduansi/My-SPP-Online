<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::latest()->get();
        return view('adminpanel.pages.kelas.manage', compact('data'));
    }

    public function store(Request $request)
    {
        $data = [
            'class_name' => strtoupper($request->class_name)
        ];

        $storeData = Kelas::create($data);
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
            'class_name' => strtoupper($request->class_name)
        ];

        $updated = Kelas::findOrFail($id)->update($updateData);

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
        $delete = Kelas::findOrFail($id)->delete();

        if($delete){
            toast('Berhasil menghapus data!','success')->timerProgressBar();
            return redirect()->back();
        }else{
            toast('Gagal menghapus data!','error')->timerProgressBar();
            return redirect()->back();
        }
    }
}
