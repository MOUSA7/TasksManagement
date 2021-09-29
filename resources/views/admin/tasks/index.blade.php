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
            <br>
{{--            <Search-Component></Search-Component>--}}
            <br>
            <form class="d-inline" action="{{route('admin.tasks.excel')}}" method="post">
                @csrf
                <input type="submit" class="btn btn-primary float-right col-5" value="Export Excel">
            </form>


        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
                <Search-Component></Search-Component>
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
                            <td class="alert-warning">{{\Carbon\Carbon::parse($task->date ?$task->date : $task->created_at)->format('d/m/Y')}}</td>
                        @else
                            <td>{{\Carbon\Carbon::parse($task->date ?$task->date : $task->arrive_time)->format('d/m/Y')}}</td>
                        @endif
                        @else
                            <td>Empty</td>
                        @endif
                        <td>{{$task->time ? $task->time : 'Empty'}}</td>
                        <td>{{Str::limit($task->description,30)}}</td>
                        <td>{{$task->category ? $task->category->name:'Not Found'}}</td>
                        <td>
                            @if($task->category->slug === "import-task")
                                <div class="progress" style=" border-radius: 5px">
                                    @if($task->Send_to_sincere == 0 && $task->driver_israel == 0 && $task->driver_gaza == 0)
                                        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                             style="width: 25%;" aria-valuenow="10" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    @elseif($task->Send_to_sincere == 1 && $task->driver_israel == 0 && $task->driver_gaza == 0)
                                        <div class="progress-bar progress-bar-striped bg-info" role="progressbar"
                                             style="width: 50%" aria-valuenow="35" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    @elseif($task->Send_to_sincere == 1 && $task->driver_israel == 1 && $task->driver_gaza == 0)
                                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"
                                             style="width: 50%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    @elseif($task->Send_to_sincere == 1 && $task->driver_gaza == 1 && $task->driver_israel == 1)
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                             style="width: 100%" aria-valuenow="25" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    @else
                                        <div class="progress-bar progress-bar-striped bg-cyan" role="progressbar"
                                             style="width: 50%" aria-valuenow="35" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    @endif
                                </div>
                            @else
                                <div class="progress" style=" border-radius: 5px">
                                    @if($task->status == "Low")
                                        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                             style="width: 25%;" aria-valuenow="10" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    @elseif($task->status == "Medium")
                                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar"
                                             style="width: 50%" aria-valuenow="75" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    @elseif($task->status == "High")
                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                             style="width: 100%" aria-valuenow="25" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    @else
                                        <div class="progress-bar progress-bar-striped " role="progressbar"
                                             style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.tasks.edit',$task->id)}}" class="btn btn-xs btn-primary">Edit</a>
                            <a href="{{url('admin/tasks/'.$task->id.'/archive')}}" class="btn btn-xs btn-dark"
                               onclick="return confirm('هل تريد إرسال المهمة الى الأرشيف'+'{{$task->name}}')">Archive</a>
                            @if($task->category->slug =="import-task")
                                <a href="{{route('admin.tasks.editor',$task->id)}}"  class="btn btn-xs btn-info " >Show</a>
                            @else
                                <a  class="btn btn-xs btn-info show" data-id="{{$task->id}}">Show</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="d-flex">
                <div class="mx-auto">
                    {{$tasks->links()}}
                </div>
            </div>

        </div>

    </div>
    <div class="modal fade" id="show-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Display Task Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" data-id="{{$task->id}}">
                    <h4></h4>
                </div>
            </div>
        </div>
    </div>
    <div id="show-Modal"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).on('click','.show',function (){
            // alert("Done")
            var id = $(this).data("id");
            $.get("tasks/"+id+'/show').done(function (data){
                console.log(data);
                $('#show-Modal').modal('show')
                $("#show-Modal .modal-body").append('<h4>'+data.name+'</h4>');
                $("#show-Modal .modal-body").empty().append('<h4>'+'Task Name : '+data.name+'</h4>'+'<br>'+'<h4>'+'Description : '+data.description+'</h4>');
            });
        });
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection


