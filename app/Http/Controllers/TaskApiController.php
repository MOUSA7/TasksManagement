<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    public function index(){
//        dd(date('h:i:s'));
//        $tasks = ['name'=>'Create Meeting','time'=>date('h:i:s'),'date'=>date(now()),'description'=>'Meeting to choose decision'];

        $tasks = Task::all();
        return response()->json(['data'=>$tasks,'status'=>200]);
    }

    public function create($slug){
//        $task = Category::whereSlug('slug',$slug)->first();
    }

    public function store(Request $request,$slug){
        $cat = Category::where('slug',$slug)->first();

        $task = $cat->tasks()->create([
            'name' => $request->name,
            'description' => $request->description,
            'time' => $request->time,
            'date' => $request->date,
            'category_id' => $cat->id,
        ]);
//        dd($task);
//        $task->save();
        if ($task){
            return response()->json(['data'=>$task,'status'=>200,'msg'=>'Successfully Created']);
        }else{
            return response()->json(['msg'=>'Something Error in This Page']);
        }
    }


    public function update(Request $request,$id){
        $task = Task::find($id);

        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'time' => $request->time,
            'date' => $request->date,
            'category_id' => $request->category_id
        ]);
        if ($task){
            return response()->json(['data'=>$task,'status'=>200,'msg'=>'Successfully Updated']);
        }else{
            return response()->json(['msg'=>'Something Error in This Page']);
        }
    }

    public function delete($id){
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['status'=>200,'msg'=>'Successfully Deleted']);

    }

    public function show($id){
        $task = Task::findOrFail($id);
        return response()->json($task);
    }
}
