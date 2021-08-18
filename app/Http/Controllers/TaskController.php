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
        $charge_place = ['china','turkish'];
        $status = ['initialize'];
        $roles = ['seen','sharing'];
//        $status = ['initialize','Waiting','Done'];
//        dd($status->key);
        $users = User::all();
        return view('admin.tasks.create',compact('category','roles','charge_place','users','status'));
    }

    public function store(Request $request,$slug){
//        $this->validate($request,[
//            'name' => 'required',
//            'description'=>'required',
//            'time'=>'required',
//            'date'=>'required'
//        ]);
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
           'policyId'=>$request->policyId
        ]);
       dd($request->all());
       if ($users = $request->user_id){
        $task->users()->attach($users);
       }
       dd($request->all());
//       dd($request->all());
        return redirect()->route('admin.categories.show',$slug);
    }

    public function edit($id){
        $task = Task::findOrFail($id);
        $status = ['initialize','Waiting','Done'];
        return view('admin.tasks.edit',compact('task','status'));
    }

    public function update(Request $request,$id){
        $task = Task::findOrFail($id);
        $this->validate($request,[
            'name' => 'required',
            'description'=>'required',
            'time'=>'required',
            'date'=>'required'
        ]);
//        dd($task->category->id);
        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'time' => $request->time,
            'date' => $request->date,
            'category_id' => $task->category->id,
            'status' => $request->status
        ]);

        return redirect()->route('admin.categories.show',$task->category->slug);
    }

    public function destroy($id){
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->back();
    }
    public function ExportCreate(){
        return view('tasks.export');
    }
    public function ExportStore(Request $request){

    }
}
