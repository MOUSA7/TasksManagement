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

    public function create(){
        return view('admin.tasks.create');
    }

    public function store(Request $request){

    }

    public function edit($id){
        $task = Task::findOrFail($id);
        return view('admin.tasks.edit',compact('task'));
    }

    public function update(Request $request,$id){

    }
}
