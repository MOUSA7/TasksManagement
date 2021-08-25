<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaskController extends Controller
{

    public function index(){
        $tasks = Task::all();
        return view('admin.tasks.index',compact('tasks'));
    }

    public function create($slug){

        $category = Category::whereSlug($slug)->first();
        $charge_place = ['Global','Euro','Other'];
        $status = ['initialize'];
        $roles = ['seen','sharing'];
//        $status = ['initialize','Waiting','Done'];
//        dd($status->key);
        $users = User::all();
        return view('admin.tasks.create',compact('category','roles','charge_place','users','status'));
    }

    public function store(Request $request,$slug){

        $cat = Category::where('slug',$slug)->first();

       $task =  $cat->tasks()->create([
            'name' => $request->name,
            'description' => $request->description,
            'time' => $request->time,
            'date' => $request->date,
            'category_id' => $cat->id,
           'status'=>$request->status,
           'place' =>$request->place,
           'appointment'=>$request->appointment,
           'exit_time'=>$request->exit_time,
           'arrive_time'=>$request->arrive_time,
           'roles'=> $request->roles,
           'policyId'=>$request->policyId,
           'created_certification'=>$request->created_certification,
           'invoice' => $request->invoice,
           'driver_israel'=>$request->driver_israel,
           'driver_gaza' => $request->driver_israel
        ]);
       if ($users = $request->user_id){
        $task->users()->attach($users);
       }

        return redirect()->route('admin.categories.show',$slug);
    }

    public function edit($id){
        $task = Task::findOrFail($id);
        $status = ['initialize','Waiting','Done'];
        $charge_place = ['Global','Euro','Other'];
        $roles = ['seen','sharing'];
        $users = User::all();

        return view('admin.tasks.edit',compact('task','users','charge_place','roles','status'));
    }

    public function update(Request $request,$id){
        $task = Task::findOrFail($id);

        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'time' => $request->time,
            'date' => $request->date,
            'category_id' => $task->category->id,
            'status'=>$request->status,
            'place' =>$request->place,
            'appointment'=>$request->appointment,
            'exit_time'=>$request->exit_time,
            'arrive_time'=>$request->arrive_time,
            'roles'=> $request->roles,
            'policyId'=>$request->policyId,
            'created_certification'=>$request->created_certification,
            'invoice' => $request->invoice,
            'driver_gaza'=>$request->driver_gaza,
            'driver_israel'=>$request->driver_israel,
        ]);
//        dd($request->all());
        return redirect()->route('admin.categories.show',$task->category->slug);
    }

    public function destroy($id){
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->back();
    }
    public function ExportEdit($id){
        $task = Task::findOrFail($id);
        $status = ['initialize','Waiting','Done'];
        return view('admin.tasks.edit_export',compact('task','status'));
    }
    public function ExportUpdate(Request $request,$id){
        $task = Task::findOrFail($id);

        if ($task->Send_to_sincere == 1){
            $request->Send_to_sincere = 1;
        }else{
            $task->update(['Send_to_sincere'=>$request->Send_to_sincere]);
        }
        if ($task->appointment != null){
            $request->appointment = $task->appointment;
        }else{
            $task->update(['appointment'=>$request->appointment]);
        }
        if ($task->secure_check != null){
            $request->secure_check = $task->secure_check;
        }else{
            $task->update(['secure_check'=>$request->secure_check]);
        }
        if ($task->status){
            $task->update(['status'=>$request->status]);
        }
        if ($task->driver_israel != null){
            $task->update(['driver_israel'=>$task->driver_israel]);
        }else{
            $task->update(['driver_israel'=>$request->driver_israel]);
        }
        if ($task->driver_gaza != null){
            $task->update(['driver_gaza'=>$task->driver_gaza]);
        }else{
            $task->update(['driver_gaza'=>$request->driver_gaza]);
        }
        $task->update(['status'=>$request->status]);
        return redirect()->back();
    }

    public function show($id){
        $task = Task::findOrFail($id);
        $status = ['initialize','Waiting','Done'];
        return view('admin.tasks.show',compact('task','status'));
    }
}
