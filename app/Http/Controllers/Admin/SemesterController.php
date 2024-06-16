<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Siswa;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class SemesterController extends Controller
{
    public function index()
    {
        $data = Semester::orderBy('id', 'desc')->get();
        $tahunAjaran = TahunAjaran::latest()->get();
        return view('adminpanel.pages.semester.manage', compact('data', 'tahunAjaran'));
    }

    public function store(Request $request)
    {
        $data = [
            'ta_id' => $request->ta_id,
            'semester_name' => strtoupper($request->semester_name),
            'start_date' => $request->start_date,
            'close_date' => $request->close_date
        ];

        $storeData = Semester::create($data);

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
            'ta_id' => $request->ta_id,
            'semester_name' => strtoupper($request->semester_name),
            'start_date' => $request->start_date,
            'close_date' => $request->close_date
        ];

        $updated = Semester::findOrFail($id)->update($updateData);

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
        $delete = Semester::findOrFail($id)->delete();

        if($delete){
            toast('Berhasil menghapus data!','success')->timerProgressBar();
            return redirect()->back();
        }else{
            toast('Gagal menghapus data!','error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function closeSemester($id)
    {
        $today = Carbon::now();
        $closeSemester = Semester::findOrFail($id)->update(array('close_date' => $today));

         //Get all students to update
         $students = Siswa::where('status', 'active')->get();
         foreach($students as $student)
         {
            $student->level_id += 1;
            $student->update();
         }
         toast('Semester di Tutup!','success')->timerProgressBar();
         return redirect()->route('semester.index');
    }
}
