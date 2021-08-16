<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,[
           'name' => 'required',
           'email'=> 'required|email|unique:users',
           'password' => 'required|password',
            'image' => 'required|mimes:jpg,png,jpeg'
        ]);
        $inputs = $request->all();

        if ($file = $request->file('image')){
            $name = $file->getClientOriginalName();
            $file->move('images',$name);
            $inputs['image'] = $name;
        }
        $inputs['password'] = bcrypt($request->password);
        User::create($inputs);

        return redirect('admin/users');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
        if(trim($request->password) == ''){
            $input = $request->except('password');
        } else{
            $input['password'] = bcrypt($request->password);
        }
//        dd($input);
        if ($file = $request->file('image')){
            $name = $file->getClientOriginalName();
            $file->move('images',$name);
            $input['image'] = $name;
        }
//        dd($request->all());
        $user->update($input);

        return redirect('admin/users');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }
}
