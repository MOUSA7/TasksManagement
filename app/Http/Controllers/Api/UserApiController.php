<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserApiController extends Controller
{

    public function index(){
        $users = User::all();
        return response()->json(['data'=>$users,'status'=>200]);
    }

    public function store(Request $request){

        $inputs = $request->all();
        if ($file = $request->file('image')){
            $name = $file->getClientOriginalName();
            $file->move('images',$name);
            $inputs['image'] = $name;
        }
        $inputs['password'] = bcrypt($request->password);
        $inputs['api_token'] = Str::random(80);
//        dd($inputs);
        $user = User::create($inputs);
        return response()->json(['data'=>$user,'status'=>201,'message'=>'User Has been Created']);

    }

    public function edit($id){
        $user = User::findOrFail($id);
        return response()->json(['data'=>$user,'status'=>200]);
    }

    public function show($id){
        $user = User::findOrFail($id);
        return response()->json(['data'=>$user,'status'=>200]);
    }

    public function update(Request $request,$id){

        $user = User::findOrFail($id);

        $inputs = $request->all();

        if ($file = $request->file('image')){
            $name = $file->getClientOriginalName();
            $file->move('images',$name);
            $inputs['image'] = $name;
        }
//        dd($inputs);
        $inputs['password'] = bcrypt($request->password);
        $user->update($inputs);
        return response()->json(['data'=>$user,'status'=>201,'message'=>'User Has been Updated']);

    }
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['data'=>$user,'status'=>200,'message'=>'User Has been deleted']);
    }
}
