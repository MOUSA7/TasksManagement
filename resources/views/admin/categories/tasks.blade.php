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
                                @if($task->status == "High")
                                <a class="badge-danger" href="{{route('admin.tasks.show',$task->id)}}">{{$task->name}}</a>
                                @elseif($task->status == "Medium")
                                <a class="badge-warning" href="{{route('admin.tasks.show',$task->id)}}">{{$task->name}}</a>
                                @else
                                    <a href="{{route('admin.tasks.show',$task->id)}}">{{$task->name}}</a>
                                @endif
                            </td>
                            <td>{{$task->policyId ?$task->policyId:'Empty'}}</td>
                            <td>{{$task->exit_time ? $task->exit_time:'Empty'}}</td>
                                <td>{{$task->arrive_time ? $task->arrive_time:'Empty'}}</td>
                                <td>{{$task->secure_check ? $task->secure_check:'Empty'}}</td>
                            <td>{{$task->appointment ? $task->appointment : 'Empty'}}</td>
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
                                <a href="{{route('admin.tasks.destroy',$task->id)}}" onclick="return confirm('هل تريد حذف هذة المهمة '+'{{$task->name}}')" class="confirm btn btn-danger btn-xs fa fa-trash-alt"></a>

                            </td>
                        </tr>
                            <!-- End IF Arrive Time !-->
                    @endif
                @endforeach
                @php
                    $tasks_date = $category->tasks()->DateTime()->get();
                @endphp
                @foreach($tasks_date as $key=>$task )
                    @if($task->category->slug ==="meeting-task" || $task->category->slug ==="general-task")
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            @if($task->status == "High")
                                <a class="badge-danger">{{$task->name}}</a>
                            @elseif($task->status == "Medium")
                                <a class="badge-warning">{{$task->name}}</a>
                            @else
                                <a>{{$task->name}}</a>
                            @endif
                        </td>
                        <td>{{date('d/m/Y',strtotime($task->date))}}</td>
                        <td>{{$task->time}}</td>
                        <td>{{Str::limit($task->description,30)}}</td>
                        <td>{{$task->category->name}}</td>
                        <td>

                            <div class="progress" style=" border-radius: 5px">
                                @if($task->status == "Low")
                                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                @elseif($task->status == "Medium")
                                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                @elseif($task->status == "High")
                                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection
