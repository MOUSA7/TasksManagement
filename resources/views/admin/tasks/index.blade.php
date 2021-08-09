@extends('admin.layouts.master')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Tasks Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                    <th>Date</th>
                    <th>Time</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $key=>$task)
                <tr>
                    <td>{{$key +1}}</td>
                    <td>{{$task->name}}</td>
                    <td>{{$task->date}}</td>
                    <td>{{$task->time}}</td>
                    <td>{{Str::limit($task->description,30)}}</td>
                    <td>{{$task->category ? $task->category->name:'Not Found'}}</td>
                    <td>
                        <a href="{{route('admin.tasks.edit',$task->id)}}" class="btn btn-xs btn-primary">Edit</a>
                        <a href="{{url('admin/tasks/'.$task->id.'/delete')}}" class="btn btn-xs btn-danger">Delete</a>
                        <a href="" class="btn btn-xs btn-info">Show</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
