<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ControllerRating extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$NIM)
    {
        $data =DB::table('rating')->where('NIM', '=',$NIM)->get();

        $data1 = new \App\ModelRating();

        $id_keluhandetail = $request->input('id_keluhandetail');
        $NIM= $request->input('NIM');
        $rating = $request->input('rating');
        $data1->id_keluhandetail = $id_keluhandetail;
        $data1->NIM = $NIM;
        $data1->rating = $rating;
        if(count($data) > 0)
            {
                if($data1->save()) {
                    $res['message'] = "Success update!";
                    $res['value'] = $data1;
                    return response($res);
                }
            }
        else
        {
            $res['message'] = "gagal";
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
