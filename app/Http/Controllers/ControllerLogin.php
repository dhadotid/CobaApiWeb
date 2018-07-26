<?php

namespace App\Http\Controllers;

use App\ModelAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class ControllerLogin extends Controller
{
  public function index()
  {
      if(!Session::get('login')){
          return redirect('login')->with('alert','You must login first');
      }
      else{
          return view('index');
      }
  }
  public function login(){
      return view('Login');
  }
  public function loginPost(Request $request){
      $NIM = $request->username;
      $password = $request->password;
      $data = ModelAdmin::where('NIM',$NIM)
        ->orWhere('email',$NIM)
        ->first();
      if($data == '')
      {
        return redirect('login')->with('alert','Not registed yet');
      }
      elseif($data->count() > 0)
      { //apakah email tersebut ada atau tidak
          if(Hash::check($password,$data->password)){
              Session::put('name',$data->name);
              Session::put('username',$data->username);
              Session::put('login',TRUE);
              return redirect('/');
          }
          else{
              return redirect('login')->with('alert','Password or Username wrong !'.Hash::check($password,$data->password));
          }
      }
  }

  public function logout()
  {
      Session::flush();
      return redirect('login')->with('alert','You already logout');
  }
}
