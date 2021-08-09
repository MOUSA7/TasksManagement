@extends('admin.layouts.master')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-4">
            <h1>Tasks Management</h1>
        </div>
        <div class="col-sm-3">
            <br>
            <br>
            <a href="{{route('admin.tasks.create',$category->slug)}}" class="btn btn-outline-success col-8">Create Task</a>
        </div>

        <div class="col-sm-5">
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
                @foreach($category->tasks as $key=>$task)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$task->name}}</td>
                    <td>{{$task->date}}</td>
                    <td>{{$task->time}}</td>
                    <td>{{Str::limit($task->description,30)}}</td>
                    <td>{{$task->category->name}}</td>
                    <td>
                        <a href="{{route('admin.tasks.edit',$task->id)}}" class="btn btn-primary btn-xs fa fa-edit edit"></a>
{{--                        <a href="{{route('admin.categories.show',$category->slug)}}" class="btn btn-info btn-xs fa fa-eye"></a>--}}
                        <a href="{{route('admin.tasks.destroy',$task->id)}}"  class="confirm btn btn-danger btn-xs fa fa-trash-alt"></a>

                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
