<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index(){
        $categories = Category::all();
        return response()->json(['data'=>$categories,'status'=>200,'msg'=>'Display Categories List']);
    }

    public function show($slug){
        $category = Category::whereSlug($slug)->first();
        return response()->json(['data'=>$category->tasks,'status'=>200,'msg'=>'Display Category tasks List']);

    }
    //
}
