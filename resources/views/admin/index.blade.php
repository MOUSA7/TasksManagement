@extends('admin.layouts.master')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Project Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Management</li>
            </ol>
        </div>
    </div>
@stop
@section('content')

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        {{$category->where('slug','import-task')->first()->tasks()->count()}}
                    </h3>

                    <p>Import Tasks</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('admin.categories.show','import-task')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
{{--                    <h3>53<sup style="font-size: 20px">%</sup></h3>--}}
                    <h3>
                        {{$category->where('slug','meeting-task')->first()->tasks()->count()}}
                    </h3>

                    <p>Meeting Tasks</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('admin.categories.show','meeting-task')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>
                        {{$category->where('slug','general-task')->first()->tasks()->count()}}
                    </h3>

                    <p>General Tasks</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('admin.categories.show','general-task')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$users->count()}}</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('admin.users.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
    </div>
{{--    <div class="text-center">--}}
{{--        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>--}}
{{--    </div>--}}
    @php
        $tasks= \App\Models\Task::where('date',\Carbon\Carbon::today()->format('m/d/Y'))->get();
    @endphp
    @if($tasks->count())
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100  btn-info" >  Today Task</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Priority</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            //$tasks = $category->tasks->sortBy('id')->values()->all();
                              $tasks = \App\Models\Task::where('date',\Carbon\Carbon::today()->format('m/d/Y'))->OrderBy('id','asc')->get();
                        @endphp
                        @forelse($tasks as $key=>$task)
                            @if($task->date  == \Carbon\Carbon::today()->format('m/d/Y'))
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>
                                        <a href="{{route('admin.tasks.edit',$task->id)}}">{{$task->name}}</a>
                                    </td>
                                    <td>{{date('d/m/Y',strtotime($task->date))}}</td>
                                    <td>{{$task->status}}</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <h2 class="text-center">Not Found</h2>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    <!-- Button trigger modal -->
    <!-- Modal -->
@stop
