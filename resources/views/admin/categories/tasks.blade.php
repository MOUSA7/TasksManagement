@extends('admin.layouts.master')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-4">
            <h1>{{\Illuminate\Support\Str::upper($category->slug)}}</h1>
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
            <br>
            <br>
            <form class="d-inline" action="{{route('admin.tasks.excel')}}" method="post">
                @csrf
                <input type="submit" class="btn btn-primary float-right col-4" value="Export Excel">
            </form>
        </div>

    </div>
@endsection

@section('content')

    <div class="row">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                @if($category->slug == "import-task")
                    <tr>
                        <th>ID</th>
                        <th>Shipment</th>
                        <th>B/L</th>
                        <th>ETD</th>
                        <th>ETA</th>
                        <th>Security Check</th>
                        <th>Coordinate</th>
                        <th>Progress</th>
                        <th>Actions</th>
                    </tr>
                @else
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
                @endif
                </thead>
                <tbody>
                @php
                    $tasks = $category->tasks()->ExitTime()->get();
                @endphp

                @foreach($tasks as $key=>$task )
                    @if($task->category->slug ==="import-task")
                            <tr>
                            <td>{{$key + 1}}</td>
                            <td>
                                <a href="{{route('admin.tasks.show',$task->id)}}">{{$task->name}}</a>
                            </td>
                            <td>{{$task->policyId ?$task->policyId:'Empty'}}</td>
                            <td>{{$task->exit_time ? $task->exit_time:'Empty'}}</td>
                                @if((\Carbon\Carbon::make($task->arrive_time) >= \Carbon\Carbon::now()->subDays(2)) && $task->secure_check == null)
                                    <td class="alert-danger">{{$task->arrive_time ? $task->arrive_time:'Empty'}}</td>
                                @else
                                <td>{{$task->arrive_time ? $task->arrive_time:'Empty'}}</td>
                                @endif
                                @if(\Carbon\Carbon::make($task->secure_check) >= \Carbon\Carbon::now()->subDays(2))
                                <td class="badge-danger">{{$task->secure_check ? $task->secure_check:'Empty'}}</td>
                                @else
                                <td>{{$task->secure_check ? $task->secure_check:'Empty'}}</td>
                                @endif
                            <td >{{$task->appointment ? $task->appointment : 'Empty'}}</td>
                            <td>
                                <div class="progress" style=" border-radius: 5px">
                                    @if($task->driver_israel == 0 && $task->driver_gaza == 0)
                                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    @elseif($task->driver_israel == 1 && $task->driver_gaza == 0)
                                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    @elseif($task->driver_gaza == 1 && $task->driver_israel == 1)
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    @else
                                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                    @endif
                                </div>
                            </td>
{{--                            <td>{{$task->policyId}}</td>--}}
                            <td>
                                <a href="{{route('admin.tasks.edit',$task->id)}}" class="btn btn-primary btn-xs fa fa-edit edit"></a>
{{--                                <a href="{{route('admin.tasks.editor',$task->id)}}" onclick="return confirm('هل تريد التعديل على المهمة '+'{{$task->name}}')" class="btn btn-info btn-xs "><i class="fas fa-arrow-right"></i></a>--}}
                                <a href="{{route('admin.tasks.editor',$task->id)}}"  class=" btn btn-info btn-xs "><i class="fas fa-arrow-right"></i></a>
                                <a href="{{route('admin.tasks.destroy',$task->id)}}"  class="confirm btn btn-danger btn-xs fa fa-trash-alt"></a>

                            </td>
                        </tr>
                            <!-- End IF Arrive Time !-->

                    @else
                        @if($task->date >= \Carbon\Carbon::now()->subDays(3))
                            <tr class="alert-warning">
                                <td>{{$key + 1}}</td>
                                <td>{{$task->name}}</td>
                                <td>{{$task->date}}</td>
                                <td>{{$task->time}}</td>
                                <td>{{Str::limit($task->description,30)}}</td>
                                <td>{{$task->category->name}}</td>
                                <td>

                                    <div class="progress" style=" border-radius: 5px">
                                        @if($task->status == 0)
                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                        @elseif($task->status == 1)
                                            <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        @elseif($task->status == 2)
                                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        @else
                                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        @endif
                                    </div>

                                </td>
                                <td>
                                    <a href="{{route('admin.tasks.edit',$task->id)}}" class="btn btn-primary btn-xs fa fa-edit edit"></a>
                                    {{--                        <a href="{{route('admin.categories.show',$category->slug)}}" class="btn btn-info btn-xs fa fa-eye"></a>--}}
                                    <a href="{{route('admin.tasks.destroy',$task->id)}}"  class="confirm btn btn-danger btn-xs fa fa-trash-alt"></a>

                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$task->name}}</td>
                                <td>{{$task->date}}</td>
                                <td>{{$task->time}}</td>
                                <td>{{Str::limit($task->description,30)}}</td>
                                <td>{{$task->category->name}}</td>
                                <td>

                                    <div class="progress" style=" border-radius: 5px">
                                        @if($task->status == 0)
                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                        @elseif($task->status == 1)
                                            <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        @elseif($task->status == 2)
                                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        @else
                                            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        @endif
                                    </div>

                                </td>
                                <td>
                                    <a href="{{route('admin.tasks.edit',$task->id)}}" class="btn btn-primary btn-xs fa fa-edit edit"></a>
                                    {{--                        <a href="{{route('admin.categories.show',$category->slug)}}" class="btn btn-info btn-xs fa fa-eye"></a>--}}
                                    <a href="{{route('admin.tasks.destroy',$task->id)}}"  class="confirm btn btn-danger btn-xs fa fa-trash-alt"></a>

                                </td>
                            </tr>
                        @endif
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
