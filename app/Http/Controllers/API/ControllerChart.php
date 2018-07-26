<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ControllerChart extends Controller
{
    public function index()
    {
      $data = DB::table('keluhan')
          ->select('keluhan.is_approved')
          ->where('is_approved',0)
          ->distinct()
          ->get();

      $pembagi = DB::table('keluhan')
              ->count();

      $persen = DB::table('keluhan')
            ->where('is_approved',0)
            ->count();

      $per1 = ($persen/$pembagi) * 100;

      $persen1 = DB::table('keluhan')
            ->where('is_approved',1)
            ->count();

      $per2 = ($persen1/$pembagi) * 100;

      $persen2 = DB::table('keluhan')
                  ->where('is_approved',2)
                  ->count();

      $per3 = ($persen2/$pembagi) * 100;


      $array = array_add(['name' => 0, 'persen' => $per1], 'jumlah', $persen);
      $array1 = array_add(['name' => 1,'persen'=> $per2],'jumlah', $persen1);
      $array2 = array_add(['name' => 2, 'persen'=> $per3],'jumlah', $persen2);


      $out = array_collapse([[$array], [$array1], [$array2]]);




      if($data == true){ //mengecek apakah data kosong atau tidak
          $res['message'] = "Success!";
          $res['value'] = $out ;
          return response($res);
      }
      else{
          $res['message'] = "Empty!";
          return response($res);
      }
    }
}
