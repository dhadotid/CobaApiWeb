<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ControllerLaunch extends Controller
{
  public function index()
  {
    $data = DB::table('laucher')
      ->orderBy('id_laucher','asc')
      ->get();

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
  public function index1($id_laucher)
  {
    $data = DB::table('pdf')
      ->where('id_laucher',$id_laucher)
      ->get();

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

  public function pdf($id_pdf)
  {
    $data = DB::table('pdf')
      ->where('id_pdf',$id_pdf)
      ->get();

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
  public function pdf_detail($id_pdf)
  {
    $data = DB::table('pdf_detail')
      ->where('id_pdf',$id_pdf)
      ->get();

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
  public function pdf_detailby($id_pdfdetail)
  {
    $data = DB::table('pdf_detail')
      ->where('id_pdfdetail',$id_pdfdetail)
      ->get();

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
  public function cari($nama)
  {
    $data = DB::table('pdf')
      ->where('nama',$nama)
      ->get();

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

}
