<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTimeZone;
use DB;
class ControllerSurveyor extends Controller
{
    public function index()
    {
        $data = DB::table('keluhan')
            ->where('is_approved', "=",0)->orWhere('is_approved', "=",1)
            ->join('users','keluhan.NIM', '=','users.NIM' )
            ->join('kategori', 'keluhan.id_kategori', "=","kategori.id_kategori")
            ->select('keluhan.*','users.name','kategori.kategori','kategori.icon')
            ->orderBy('is_approved','asc')->orderBy('id_keluhan','desc' )
            ->simplePaginate(8)
        ;

        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
            $res['message'] = "Success!";
            $res['values'] = $data;
            return response($res);
        }
        else{
            $res['message'] = "Empty!";
            return response($res);
        }
    }
    public function update(Request $request,$id_keluhan)
    {
        $is_approved = $request->input('is_approved');
        $data = \App\ModelKeluhan::where('id_keluhan',$id_keluhan)->first();
        $data->is_approved = $is_approved ;
        $data -> updated_at = Carbon::now(new DateTimeZone('Asia/Jakarta'));

       
                if($data->save()){ //mengecek apakah data kosong atau tidak
                    $res['message'] = "Success!";
                    $res['values'] = $data;
                    return response($res);
                }
                else{
                    $res['message'] = "Empty!";
                    return response($res);
                }

    }
}
