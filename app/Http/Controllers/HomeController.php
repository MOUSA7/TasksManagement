<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('dashboard');
    }


    public function index()
    {
        return view('home');
    }

    public function dashboard(){
        $category = Category::with(['tasks'=>function($query){
           return $query->latest();
        }])->firstOrFail();

        $users = User::all();
        return view('admin.index',compact('category','users'));
    }

    public function logout(){
        if (\auth()->check()){
            Auth::logout();
            return redirect('/login');
        }
    }
}
