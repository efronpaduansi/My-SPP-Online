<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $profile = User::where('id', auth()->user()->id)->first();

        return view('adminpanel.pages.profile.my_profile', compact('profile'));
    }

    public function updateProfile(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];

        $update = User::where('id', $id)->update($data);

        if($update){
            toast('Perubahan berhasil di simpan!','success')->timerProgressBar();
            return redirect()->back();
        }else{
            toast('Perubahan gagal di simpan!','error')->timerProgressBar();
            return redirect()->back();
        }

    }

    //Update user password by ID
    public function updatePassword(Request $request, $id)
    {
        //get User data where id = $id
        $getUser = User::where('id', $id)->first();

        if(!$getUser || !Hash::check($request->oldPass, $getUser->password)){
            toast('Perubahan gagal di simpan!','error')->timerProgressBar();
            return redirect()->back();
        }

        //Check password match
        if($request->newPass != $request->passConf){
            toast('Perubahan gagal di simpan!','error')->timerProgressBar();
            return redirect()->back();
        }

        //Update User password with request new pass
        $updateUserPassword = User::where('id', $id)->update(array('password' => Hash::make($request->newPass)));
        if($updateUserPassword){
            toast('Perubahan berhasil di simpan!','success')->timerProgressBar();
            return redirect()->back();
        }else{
            toast('Perubahan gagal di simpan!','error')->timerProgressBar();
            return redirect()->back();
        }
    }

    //DANGER ZONE: delete User account by ID
    public function deleteAccount(Request $request, $id)
    {
        $deleteUserAccount = User::where('id', $id)->delete();

        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        toast('Anda berhasil logout!','success');
        return redirect('/');
    }
}
