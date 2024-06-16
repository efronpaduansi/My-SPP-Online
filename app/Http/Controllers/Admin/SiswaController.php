<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Semester;
use App\Models\LevelSiswa;
use Illuminate\Http\Request;
use App\Models\KartuKeluarga;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{

    private function generateNextNIS(){
        $lastNIS = Siswa::max('nis');

        if($lastNIS){
            $nextNIS = $lastNIS + 1;
        }else{
            $nextNIS = date('Ym') . 001; 
        }
        return $nextNIS;
    }

    public function index()
    {
        $data = Siswa::latest()->get();
        return view('adminpanel.pages.siswa.manage', compact('data'));
    }

    public function show($nis)
    {
        $siswa = Siswa::where('nis', $nis)->first();
        return view('adminpanel.pages.siswa.show', compact('siswa'));
    }

    public function create()
    {
        $nextNIS = $this->generateNextNIS();
        $kelas = Kelas::latest()->get();
        $levels = LevelSiswa::latest()->get();
        return view('adminpanel.pages.siswa.create', compact('kelas', 'levels', 'nextNIS'));
    }

    public function store(Request $request)
    {
        //check if nis is available
        $cekNIS = Siswa::where('nis', $request->nis)->first();

        if($cekNIS){
            toast('No. Induk Siswa sudah digunakan!','error')->timerProgressBar();
            return redirect()->back();
        }

        //check no_kk is already set
        $cekKK = KartuKeluarga::where('no_kk', $request->no_kk)->first();

        if($cekKK){
            $kkID = $cekKK->id;
        }else{
            //save no_kk to kartu_keluarga table
            $dataKK = [
                'no_kk' => $request->no_kk
            ];
            $storeDataKK = KartuKeluarga::create($dataKK);
            $getKKID = KartuKeluarga::latest()->first();
            $kkID = $getKKID->id;
        }

        $dataSiswa = [
            'nis' => $request->nis,
            'kk_id' => $kkID,
            'level_id' => $request->level_id,
            'class_id' => $request->class_id,
            'nik' => $request->nik,
            'name' => strtoupper($request->name),
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => strtoupper($request->address),
            'status' => 'active'
        ];

        //save data siswa to siswa table
        $storeDataSiswa = Siswa::create($dataSiswa);

        if($storeDataSiswa){
            toast('Berhasil menambahkan data!','success')->timerProgressBar();
            return redirect()->route('siswa.index');
        }else{
            toast('Gagal menambahkan data!','error')->timerProgressBar();
            return redirect()->route('siswa.index');
        }
    }

    public function edit($nis)
    {
        $siswa = Siswa::where('nis', $nis)->first();
        $kelas = Kelas::latest()->get();
        $levels = LevelSiswa::latest()->get();

        return view('adminpanel.pages.siswa.edit', compact('siswa', 'kelas', 'levels'));
    }

    public function update(Request $request, $nis)
    {
          //check no_kk is already set
        $cekKK = KartuKeluarga::where('no_kk', $request->no_kk)->first();

        if($cekKK){
            $kkID = $cekKK->id;
        }else{
            //save no_kk to kartu_keluarga table
            $dataKK = [
                'no_kk' => $request->no_kk
            ];
            $storeDataKK = KartuKeluarga::create($dataKK);
            $getKKID = KartuKeluarga::latest()->first();
            $kkID = $getKKID->id;
        }

        $dataSiswa = [
            'nis' => $request->nis,
            'kk_id' => $kkID,
            'level_id' => $request->level_id,
            'class_id' => $request->class_id,
            'nik' => $request->nik,
            'name' => strtoupper($request->name),
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => strtoupper($request->address),
            'status' => 'active'
        ];

        $updateDataSiswa = Siswa::where('nis', $nis)->update($dataSiswa);

        if($updateDataSiswa){
            toast('Berhasil mengubah data!','success')->timerProgressBar();
            return redirect()->route('siswa.index');
        }else{
            toast('Gagal mengubah data!','error')->timerProgressBar();
            return redirect()->route('siswa.index');
        }
    }

    public function setStudentStatus($nis)
    {
        $getStatus = Siswa::where('nis', $nis)->first();

        if($getStatus->status == 'active'){
            $deactivateStudent = Siswa::where('nis', $nis)->update(array('status' => 'inactive'));
            if($deactivateStudent){
                toast('Berhasil mengubah data!','success')->timerProgressBar();
                return redirect()->route('siswa.index');
            }else{
                return false;
            }
        }elseif($getStatus->status == 'inactive'){
            $activateStudent = Siswa::where('nis', $nis)->update(array('status' => 'active'));
            if($activateStudent){
                toast('Berhasil mengubah data!','success')->timerProgressBar();
                return redirect()->route('siswa.index');
            }else{
                return false;
            }
        }else{
            toast('Gagal mengubah data!','error')->timerProgressBar();
            return redirect()->route('siswa.index');
        }
    }

    public function destroy($nis)
    {
        $delete = Siswa::where('nis', $nis)->delete();

        if($delete){
            toast('Berhasil menghapus data!','success')->timerProgressBar();
            return redirect()->route('siswa.index');
        }else{
            toast('Gagal menghapus data!','error')->timerProgressBar();
            return redirect()->route('siswa.index');
        }
    }
}
