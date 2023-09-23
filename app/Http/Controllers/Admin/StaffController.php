<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index()
    {
        $data = User::orderBy('name', 'asc')->get();
        return view('adminpanel.pages.staff.manage', compact('data'));
    }

    public function create()
    {
        $roles = UserRole::all();
        return view('adminpanel.pages.staff.create', compact('roles'));
    }

    public function store(Request $request)
    {
        //cek password confirmation
        if($request->password != $request->passConf){
            toast('Staff gagal di tambahkan!','error')->timerProgressBar();
            return redirect()->back();
        }

        $data = [
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        //store user data
        $storeNewStaff = User::create($data);

        if($storeNewStaff){
            toast('Staff berhasil di tambahkan!','success')->timerProgressBar();
            return redirect()->route('staff.index');
        }else{
            toast('Staff gagal di tambahkan!','error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $staff = User::where('id', $id)->first();
        $roles = UserRole::all();
        return view('adminpanel.pages.staff.edit', compact('staff', 'roles'));
    }

    public function update(Request $request, $id)
    {
        
        $data = [
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
        ];
        if(!empty($request->password) || !empty($request->passConf)){
            $validated = Validator::make($request->all(), [
                'password' => 'required',
                'passConf' => 'required'
            ]);

            if(!$validated->passes()){
                toast('Staff gagal di ubah. Perhatikan kembali inputan Anda!','error')->timerProgressBar();
                return redirect()->back();
            }

            if($request->password == $request->passConf){
                $data['password'] = Hash::make($request->password);
            }
        }

        //update staff by ID
        $updateStaff = User::where('id', $id)->update($data);

        if($updateStaff){
            toast('Staff berhasil di ubah!','success')->timerProgressBar();
            return redirect()->route('staff.index');
        }else{
            toast('Staff gagal di ubah!','error')->timerProgressBar();
            return redirect()->back();
        }
    }

    //Delete staff by ID
    public function destroy($id)
    {
        $deleteStaff = User::where('id', $id)->delete();

        if($deleteStaff){
            toast('Staff berhasil di hapus!','success')->timerProgressBar();
            return redirect()->back();
        }else{
            toast('Staff gagal di hapus!','error')->timerProgressBar();
            return redirect()->back();
        }
    }
}
