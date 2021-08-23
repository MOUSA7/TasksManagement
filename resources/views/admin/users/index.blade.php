@extends('admin.layouts.master')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-4">
            <h1>Users Management</h1>
        </div>
        <div class="col-sm-3">
            <br>
            <br>
            <a href="{{route('admin.users.create')}}" class="btn btn-outline-dark col-8">Create User</a>
        </div>
        <div class="col-sm-5">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Tasks</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Tasks Count</th>
                    <th>Time</th>
                    <th>Operation</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key=>$user)
                    <tr>
                        <td>{{$key +1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <img src="{{'/images/'.$user->image}}" height="60px" width="70px" alt="">
                        </td>
                        <td>{{$user->tasks->count()}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>
                            <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-xs btn-primary">Edit</a>
                            <a href="{{route('admin.users.destroy',$user->id.'/delete')}}" class="btn btn-xs btn-danger">Delete</a>
                            <a href="#" class="btn btn-xs btn-info">Show</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
