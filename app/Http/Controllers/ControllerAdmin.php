<?php

namespace App\Http\Controllers;

use App\ModelAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;

class ControllerAdmin extends Controller
{
  public function index()
  {
      if(!Session::get('login')){
          return redirect('login')->with('alert','Kamu harus login dulu');
      }
      else{
          $admin = DB::table('users')
              ->get();
          return view('admin',compact('admin'));
      }
  }
  public function create()
    {
        return view('adminstore');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'NIM' => 'required|unique:users,NIM',
            'name' => 'required',
            'email' => 'required|min:4|unique:users,email',
            'password' => 'required|min:8',
            'roles' => 'required|integer|between:1,4',
            'confirmation' => 'required|same:password',
        ]);
        $Admin = new \App\ModelAdmin();

        $NIM = $request->input('NIM');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $roles = $request->input('roles');

        $Admin->NIM = $NIM;
        $Admin->name = $name;
        $Admin->email = $email;
        $Admin->password = bcrypt($password);
        $Admin->roles = $roles;
        $Admin->save();
        return redirect()->route('account.index')->with('alert-success', 'Success insert data!');
    }
    public function edit($NIM)
    {
        $Admin= \App\ModelAdmin::findOrFail($NIM);
        return view('adminupdate',compact('Admin'));
    }
    public function update(Request $request, $NIM)
    {
        $Admin = ModelAdmin::where('NIM',$NIM)
          ->first();
        $oldpass = $request->oldpass;
        $newpass = $request->newpass;

        if($Admin == '')
        {
          return redirect('admin')->with('alert','Wrong pass');
        }
        elseif($Admin->count() > 0)
        { //apakah email tersebut ada atau tidak
            if(Hash::check($oldpass,$Admin->password)){
              $name = $request->input('name');
              $email = $request->input('email');
              $roles = $request->input('roles');
              $newpass = $request->input('newpass');

              $Admin->name = $name;
              $Admin->email = $email;
              $Admin->roles = $roles;
              $Admin->password = bcrypt($newpass);
              $Admin->save();
              return redirect()->route('account.index')->with('alert-success','Success update data!');
            }
            else{
                return redirect()->route('account.index')->with('alert-danger','Password wrong !'.Hash::check($oldpass,$Admin->password));
            }
        }

    }
    public function destroy($NIM)
    {
        if (DB::table('users')->where('NIM',$NIM)->where('status',0)->update([
            'status' => 1
        ]));
        elseif (DB::table('users')->where('NIM',$NIM)->where('status',1)->update([
            'status' => 0
        ]));
        return redirect()->route('account.index')->with('alert-success','Success delete data!');
    }

}
