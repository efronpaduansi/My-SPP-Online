<?php

namespace App\Http\Controllers\Admin;

use App\Models\LevelSiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;                                                                      
class LevelSiswaController extends Controller
{
    public function index()
    {
        $data = LevelSiswa::latest()->get();
        return view('adminpanel.pages.level.manage', compact('data'));
    }

    public function store(Request $request)
    {
        $data = [
            'level_name' => strtoupper($request->level_name),
            'start_nominal' => $request->start_nominal
        ];

        $storeData = LevelSiswa::create($data);

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
        $updatedData = [
            'level_name' => strtoupper($request->level_name),
            'start_nominal' => $request->start_nominal
        ];

        $update = LevelSiswa::findOrFail($id)->update($updatedData);

        if($update){
            toast('Berhasil mengubah data!','success')->timerProgressBar();
            return redirect()->back();
        }else{
            toast('Gagal mengubah data!','error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $delete = LevelSiswa::findOrFail($id)->delete();

        if($delete){
            toast('Berhasil menghapus data!','success')->timerProgressBar();
            return redirect()->back();
        }else{
            toast('Gagal menghapus data!','error')->timerProgressBar();
            return redirect()->back();
        }
    }
}
