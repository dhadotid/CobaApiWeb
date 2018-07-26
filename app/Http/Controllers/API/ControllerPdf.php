<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModelPdf;
use DateTimeZone;
use Carbon\Carbon;
class ControllerPdf extends Controller
{
  public function store(Request $request)
  {

      date_default_timezone_set('Asia/Jakarta');
      $data = new \App\ModelPdf();
      $id_pdf = $request->input('id_pdf');
      $nama = $request->input('nama');
      $gambar = $request->file('gambar');
      $ext = $gambar->getClientOriginalExtension();
      $newName = date('Ymd_his').".".$ext;
      $gambar->move('uploads/file',$newName);
      $link =  $request->file('link');
      $ext1 = $link->getClientOriginalExtension();
      $newName1 =  date('Ymd_his').".".$ext1;
      $link->move('uploads/pdf',$newName1);

      $data->id_pdf = $id_pdf;
      $data->nama = $nama;
      $data->gambar = $newName;
      $data->link = $newName1;
      $data ->created_at = Carbon::now(new DateTimeZone('Asia/Jakarta'));
      $data ->updated_at = Carbon::now(new DateTimeZone('Asia/Jakarta'));
      if($data->save()){
          $res['message'] = "Success!";
          $res['value'] = "$data";
          return response($res);
      }
  }
  public function update(Request $request,$id_pdfdetail)
  {
      date_default_timezone_set('Asia/Jakarta');
      $id_pdf = $request->input('id_pdf');
      $nama = $request->input('nama');
      $gambar = $request->file('gambar');
      $ext = $gambar->getClientOriginalExtension();
      $newName = date('Ymd_his').".".$ext;
      $gambar->move('uploads/file',$newName);
      $link =  $request->file('link');
      $ext1 = $link->getClientOriginalExtension();
      $newName1 =  date('Ymd_his').".".$ext1;
      $link->move('uploads/pdf',$newName1);
      $data = \App\ModelPdf::where('id_pdfdetail',$id_pdfdetail)->first();

      $data->id_pdf = $id_pdf;
      $data->nama = $nama;
      $data->gambar = $newName;
      $data->link = $newName1;
      $data->created_at = Carbon::now(new DateTimeZone('Asia/Jakarta'));
      $data->updated_at = Carbon::now(new DateTimeZone('Asia/Jakarta'));

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
