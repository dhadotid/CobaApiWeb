<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTimeZone;
use DB;
use Carbon\Carbon;
class ControllerKeluhan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($NIM)
    {
            $data = DB::table('keluhan')->where('is_approved', "!=",0)
                ->join('users','keluhan.NIM', '=','users.NIM' )
                ->join('kategori', 'keluhan.id_kategori', "=","kategori.id_kategori")
                ->select('keluhan.*','users.name','kategori.kategori','kategori.icon')
                ->where('users.NIM',$NIM)
                ->orderBy('id_keluhan','desc')
                ->simplePaginate(8);
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

    public function index1()
    {
        $data = DB::table('keluhan')->where('is_approved', "!=",0)
            ->join('users','keluhan.NIM', '=','users.NIM' )
            ->join('kategori', 'keluhan.id_kategori', "=","kategori.id_kategori")
            ->select('keluhan.*','users.name','kategori.kategori','kategori.icon')
            ->orderBy('id_keluhan','desc')
            ->simplePaginate(4);
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new \App\ModelKeluhan();
        $id_keluhan = $request->input('id_keluhan ');
        $NIM= $request->input('NIM');
        $id_kategori= $request->input('id_kategori');
        $deskripsi = $request->input('deskripsi');
        $foto = $request->file('foto');
        $lokasi = $request->input('lokasi');
        $ext = $foto->getClientOriginalExtension();
        $newName = rand(100000,1001238912).".".$ext;
        $foto->move('uploads/file',$newName);

        $time_post = $request->input('time_post');
        $is_approved = $request->input('is_approved');
        $is_delete = $request->input('is_delete');
        $deleted_time = $request->input('deleted_time');
        $data->id_keluhan = $id_keluhan ;
        $data->NIM = $NIM;
        $data->id_kategori = $id_kategori;
        $data->deskripsi= $deskripsi;
        $data->foto = $newName;
        $data->lokasi=$lokasi;
        $data->time_post = $time_post;
        $data->is_approved = $is_approved;
        $data->is_delete  =$is_delete;
        $data->deleted_time =$deleted_time;
        $data -> created_at = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        $data -> updated_at = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        if($data->save()){
            $res['message'] = "Success!";
            $res['value'] = "$data";
            return response($res);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
