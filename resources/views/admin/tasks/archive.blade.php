@extends('admin.layouts.master')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>History Tasks</h1>
            <br>
            <a href="{{ URL::previous() }}" class="btn btn-default" style="margin-top: -8px;"> <i class="fa fa-arrow-left"></i> Go Back</a>
        </div>
        <div class="col-sm-6">
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
                    <th>Date</th>
                    <th>Time</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Progress</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trashes as $key=>$task)
                    <tr>
                        <td>{{$key +1}}</td>
                        <td>
                            @if($task->status == "High")
                                <a class="badge-danger">{{$task->name}}</a>
                            @elseif($task->status == "Medium")
                                <a class="badge-warning">{{$task->name}}</a>
                            @else
                                <a>{{$task->name}}</a>
                            @endif
                        </td>
                        @if($task->date !=null || $task->arrive_time)
                            @if(\Carbon\Carbon::parse($task->date)->format('d/m/Y')  >= \Carbon\Carbon::now()->subDays(2))
                                <td class="alert-warning">{{\Carbon\Carbon::parse($task->date ?$task->date : "Empty")->format('d/m/Y')}}</td>
                            @else
                                <td>{{\Carbon\Carbon::parse($task->date ?$task->date : $task->arrive_time)->format('d/m/Y')}}</td>
                            @endif
                        @else
                            <td>Empty</td>
                        @endif
                        <td>{{$task->time ? $task->time : 'Empty'}}</td>
                        <td>{{Str::limit($task->description,30)}}</td>
                        <td>{{$task->category ? $task->category->name:'Not Found'}}</td>
                        <td>{{$task->status}}</td>
                        <td>
                            <a href="{{route('admin.tasks.restore',$task->id)}}" class="btn btn-xs btn-primary">Restore</a>
                            <a href="{{route('admin.tasks.delete',$task->id)}}" class="btn btn-xs btn-danger">Delete</a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection



