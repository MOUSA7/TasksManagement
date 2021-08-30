@extends('admin.layouts.master')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Tasks Management</h1>
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
                @foreach($tasks as $key=>$task)
                  @if(\Carbon\Carbon::make($task->date)  >= \Carbon\Carbon::now()->subDays(2))
                   <tr class="alert-warning">
                    <td>{{$key +1}}</td>
                    <td>{{$task->name}}</td>
                    <td>{{$task->date ? $task->date :$task->arrive_time}}</td>
                    <td>{{$task->time ? $task->time : 'Empty'}}</td>
                    <td>{{Str::limit($task->description,30)}}</td>
                    <td>{{$task->category ? $task->category->name:'Not Found'}}</td>
                    <td>
                        @if($task->category->slug === "import-task")
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
                        @else
                            <div class="progress" style=" border-radius: 5px">
                                @if($task->status == 0)
                                    <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                @elseif($task->status == 1)
                                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                @elseif($task->status == 2)
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                @else
                                    <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                @endif
                            </div>

                        @endif
                    </td>
                    <td>
                        <a href="{{route('admin.tasks.edit',$task->id)}}" class="btn btn-xs btn-primary">Edit</a>
                        <a href="{{url('admin/tasks/'.$task->id.'/delete')}}" class="btn btn-xs btn-danger">Delete</a>
                        <a href="" class="btn btn-xs btn-info">Show</a>
                    </td>
                </tr>
                  @else
                      <tr>
                          <td>{{$key +1}}</td>
                          <td>{{$task->name}}</td>
                          <td>{{$task->date ? $task->date :$task->arrive_time}}</td>
                          <td>{{$task->time ? $task->time : 'Empty'}}</td>
                          <td>{{Str::limit($task->description,30)}}</td>
                          <td>{{$task->category ? $task->category->name:'Not Found'}}</td>
                          <td>
                              @if($task->category->slug === "import-task")
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
                              @else
                                  <div class="progress" style=" border-radius: 5px">
                                      @if($task->status == 0)
                                          <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                      @elseif($task->status == 1)
                                          <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                      @elseif($task->status == 2)
                                          <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                      @else
                                          <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                      @endif
                                  </div>

                              @endif
                          </td>
                          <td>
                              <a href="{{route('admin.tasks.edit',$task->id)}}" class="btn btn-xs btn-primary">Edit</a>
                              <a href="{{url('admin/tasks/'.$task->id.'/delete')}}" class="btn btn-xs btn-danger">Delete</a>
                              <a href="" class="btn btn-xs btn-info">Show</a>
                          </td>
                      </tr>
                  @endif
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
