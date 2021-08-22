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
                        <th>name</th>
                        <th>Place</th>
                        <th>appointment</th>
                        <th>Description</th>
                        <th>Exit Time</th>
                        <th>Arrive Time</th>
                        <th>Role</th>
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
                @foreach($category->tasks as $key=>$task)
                    @if($task->category->slug ==="import-task")
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>
                                <a href="{{route('admin.tasks.show',$task->id)}}">{{$task->name}}</a>
                            </td>
                            <td>{{$task->place}}</td>
                            <td>{{$task->appointment}}</td>
                            <td>{{Str::limit($task->description,30)}}</td>
                            <td>{{$task->exit_time}}</td>
                            <td>{{$task->arrive_time}}</td>
                            <td>{{$task->roles}}</td>
                            <td>
                                <div class="progress" style=" border-radius: 5px">
                                    @if($task->status == "initialize")
                                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    @elseif($task->status == "Waiting")
                                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    @elseif($task->status == "Done")
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    @else
                                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                    @endif
                                </div>
                            </td>
{{--                            <td>{{$task->policyId}}</td>--}}
                            <td>
                                <a href="{{route('admin.tasks.edit',$task->id)}}" class="btn btn-primary btn-xs fa fa-edit edit"></a>
                                <a href="{{route('admin.tasks.editor',$task->id)}}" onclick="return confirm('هل تم أرسالها الى المخلصة '+'{{$task->name}}')" class="btn btn-info btn-xs "><i class="fas fa-arrow-right"></i></a>
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
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
