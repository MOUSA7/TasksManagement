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
                @if($task->category->slug == "import-task")
                    <form action="{{route('admin.tasks.update',$task->id)}}" method="post">
                        @method('put')
                        @csrf
                        <div class="card">
                            <div class="card-header"><b>{{ __('Update Task') }}</b></div>

                            <div class="card-body" id="import_form">
                                <div class="row">
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="">Name : </label>
                                            <input type="text" value="{{$task->name}}" name="name" class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="">Shipping Date : </label>
                                            <input type="date" value="{{$task->exit_time}}" name="exit_time" class="form-control @error('date') is-invalid @enderror">
                                            @error('date')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group" style="padding-top: 0px">
                                            <label for="">Users : </label>
                                            <select  name="user_id[]" id="category" class="form-control" multiple>
                                                @foreach($task->users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="">Description :</label>
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror">
                                                {{$task->description}}
                                            </textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6 ">

                                        <div class="form-group">
                                            <label for="">Charge Place : </label>
                                            <select name="place" id="place"  class="form-control" >
                                                @foreach($charge_place as $key=>$place)
                                                    <option  value="{{$place}}">{{$place}}</option>
                                                    {{--                                                <option value="{{$key}}">{{$state}}</option>--}}
                                                @endforeach
                                            </select>
                                            @error('place')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="">Arrive Time : </label>
                                            <input type="date" value="{{$task->arrive_time}}" name="arrive_time" class="form-control @error('arrive_time') is-invalid @enderror">
                                            @error(' arrive_time')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="">Roles : </label>
                                            <select name="roles"  class="form-control" >
                                                @foreach($roles as $key=>$role)
                                                    <option  value="{{$role}}">{{$role}}</option>
                                                    {{--                                                <option value="{{$key}}">{{$state}}</option>--}}
                                                @endforeach
                                            </select>
                                            @error('role')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group" id="policy">
                                            <label for="">PolicyId : </label>
                                            <input type="text" value="{{$task->policyId}}" name="policyId" class="form-control @error('policyId') is-invalid @enderror">
                                            @error('policyId')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-check" id="certificate">
                                            <input  class="form-check-input" name="created_certification" value="{{$task->created_certification == 1?'checked':0}}"  type="checkbox" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Created Certification
                                            </label>
                                        </div>

                                        <div class="form-check" id="invoice">
                                            <input  class="form-check-input" name="invoice" value="{{$task->invoice == 1?'checked':0}}" type="checkbox" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Invoice
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="text-center" id="save">
                            <input type="submit" class="btn btn-primary col-5" value="Create Task">
                        </div>
                    </form>

                @else
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
                                            @error('status')
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

                @endif

            </div>
        </div>
    </div>

@endsection
<style>
    #policy{
        display: none;
    }
    #certificate{
        display: none;
    }
    #invoice{
        display: none;
    }
</style>
