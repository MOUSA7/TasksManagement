<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'name' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        return view('admin.categories.bodyCategories',['categories'=> Category::all()]);

    }
    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.categories.edit',compact('category'));
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'name' => 'required'
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        return view('admin.categories.bodyCategories')->with('categories',Category::get());
    }

    public function destroy($id){
        Category::destroy($id);
        return view('admin.categories.bodyCategories')->with('categories',Category::get());
    }

    public function show($slug){
        $category = Category::whereSlug($slug)->first();
//        $cat = $category->tasks()->ExitTime()->get();
        return view('admin.categories.tasks',compact('category'));
    }

}
