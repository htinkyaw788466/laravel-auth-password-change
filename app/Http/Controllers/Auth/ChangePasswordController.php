<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('auth.passwords.change');
    }

    public function update(Request $request){
        $this->validate($request,[
            'old_password'=>'required',
            'password'=>"required|confirmed"
        ]);

        $hashedPassword=Auth::user()->password;
        if(Hash::check($request->old_password,$hashedPassword)){
            $user=User::find(Auth::id());
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')
                   ->with('successMsg','password updated successfully');
        }else{
            return redirect()->back()->with('errorMsg','current password is invalid');
        }
    }
}
