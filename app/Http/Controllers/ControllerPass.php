<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerPass extends Controller
{
  public function edit($NIM)
  {
    if(!Session::get('login')){
        return redirect('login')->with('alert','Kamu harus login dulu');
    }
    else{
      $Admin= \App\ModelAdmin::findOrFail($NIM);
      return view('adminpass',compact('Admin'));
    }


  }
}
