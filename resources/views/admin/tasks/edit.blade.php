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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{route('admin.tasks.update',$task->id)}}" method="post">
                    @csrf
                    @method('PUT')
                <div class="card">
                    <div class="card-header">{{ __('Edit Task') }}</div>

                    <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Name : </label>
                                            <input type="text" name="name" value="{{$task->name}}" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Date : </label>
                                            <input type="date" value="{{$task->date}}" name="date" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Status : </label>
                                            <select name="status"  class="form-control" >
                                                @foreach($status as $key=>$state)
                                                    <option value="{{$key}}">{{$state}}</option>
                                                    {{--                                                <option value="{{$key}}">{{$state}}</option>--}}
                                                @endforeach
                                            </select>
                                            @error('date')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Time</label>
                                            <input type="time" value="{{$task->time}}" name="time" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Description :</label>
                                            <textarea name="description" class="form-control">{{$task->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-outline-dark col-5" value="Edit Task">

                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
