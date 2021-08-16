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
                <form action="{{route('admin.tasks.store',$category->slug)}}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">{{ __('Create Task') }}</div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Name : </label>
                                        <input type="text" placeholder="Task Name" name="name"  class="form-control @error('name') is-invalid @enderror">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Date : </label>
                                        <input type="date" name="date" class="form-control @error('date') is-invalid @enderror">
                                        @error('date')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group" style="padding-top: 25px">
                                        <label for="">Users : </label>
                                        <select  name="user_id[]" id="category" class="form-control" multiple>
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('date')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6 ">

                                    <div class="form-group">
                                        <label for="">Time</label>
                                        <input type="time"  name="time" class="form-control @error('time') is-invalid @enderror">
                                        @error('time')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Description :</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Status : </label>
                                        <select name="status"  class="form-control" >
                                            @foreach($status as $key=>$state)
                                                <option value="0">{{$state}}</option>
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
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary col-5" value="Create Task">

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
