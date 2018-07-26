<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Illuminate\Support\Facades\Mail;
class UserController extends Controller
{
    public $successStatus = 200;

    public function login(){
        if(Auth::attempt(['NIM' => request('NIM'),'password' => request('password'),'status' => 1])){
            $user = Auth::user();
            $success['NIM'] = $user->NIM;
            $success['name'] =  $user->name;
            $success['email'] = $user->email;
            $success['roles'] = $user->roles;
            $success['status'] = $user->status;
            $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['status' => $success], $this->successStatus);
        }
        elseif(Auth::attempt(['email' => request('NIM'),'password' => request('password'),'status' => 1 ])){
            $user = Auth::user();
            $success['NIM'] = $user->NIM;
            $success['name'] =  $user->name;
            $success['email'] = $user->email;
            $success['roles'] = $user->roles;
            $success['status'] = $user->status;
            $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['status' => $success], $this->successStatus);
        }
        elseif(Auth::attempt(['NIM' => request('NIM'),'password' => request('password'),'status' => 0 ])){
            return response()->json(['status' => '69'], 401);
        }
        elseif(Auth::attempt(['email' => request('NIM'),'password' => request('password'),'status' => 0 ])){
            return response()->json(['status' => '68'], 401);
        }
        else{
            return response()->json(['status'=>'201'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NIM' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['name'] =  $user->name;
        $success['email'] =  $user->email;
        $success['roles'] = $user->roles;

        return response()->json(['success'=>$success], $this->successStatus);
    }
    public function update (Request $request, $NIM)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $roles = $request->input('roles');

        $data = \App\User::where('NIM',$NIM)->first();
        $data->name = $name;
        $data->email = $email;
        $data->roles = $roles;

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
    public function verifuser (Request $request)
    {
        $NIM = $request->input('NIM');
        $email = $request->input('email');
        $status = $request->input('status');

        $cek = \App\User::where('email',$email)->count();
        if($cek>0)
        {
          $data = \App\User::where('NIM',$NIM)->first();
          $data->status = $status;

          if($data->save()){ //mengecek apakah data kosong atau tidak
              $res['message'] = "Success!";
              $res['values'] = $data;
                try{
                $emails = DB::table('users')->where('NIM',$NIM)->get();
                foreach ($emails as $email)
                {
                Mail::send('email', ['nama' => $email->name, 'pesan' => 'Akun anda sudah diverivikasi1'], function ($message) use ($request,$emails)
                {
                    $message->subject('Verivikasi akun');
                    $message->from('smartsip@rsypj.com', 'Smartsip');
                    foreach ($emails as $email)
                    {
                        $message->to($email->email);
                    }
                });
              }
                $res['email'] = "Success!";
                }
                catch (Exception $e){
                    $res['email'] = "Failed";
                }
            return response($res);
          }
          else{
              $res['message'] = "Empty!";
              return response($res);
          }
        }
        else
        {
          $res['message'] = 'Your email wrong';
          return response($res);
        }

    }

    public function index()
    {
        $data = DB::table('users')->simplePaginate(8);

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
    public function datanol()
    {
        $data = DB::table('users')
          ->where('status','0')
          ->orderBy('created_at','desc')
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
}
