<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
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
        return view('admin.tasks.create',compact('category'));
    }

    public function store(Request $request,$slug){
        $this->validate($request,[
            'name' => 'required',
            'description'=>'required',
            'time'=>'required',
            'date'=>'required'
        ]);
        $cat = Category::where('slug',$slug)->first();

        $cat->tasks()->create([
            'name' => $request->name,
            'description' => $request->description,
            'time' => $request->time,
            'date' => $request->date,
            'category_id' => $cat->id,
        ]);
        return redirect()->route('admin.categories.show',$slug);
    }

    public function edit($id){
        $task = Task::findOrFail($id);
        return view('admin.tasks.edit',compact('task'));
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
            'category_id' => $task->category->id
        ]);

        return redirect()->route('admin.categories.show',$task->category->slug);
    }

    public function destroy($id){
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->back();
    }
}
