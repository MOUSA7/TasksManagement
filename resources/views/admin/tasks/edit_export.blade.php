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
                <form action="{{route('admin.tasks.editor.update',$task->id)}}" method="post">
                    @csrf
                    @method('PUT')
                <div class="card">
                    <div class="card-header text-center">{{ __('Export Task') }}</div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Appointment Arrive Into Gaza : </label>
                            <input id="date" type="date" value="{{$task->appointment ? $task->appointment :''}}" name="appointment" class="form-control @error('appointment') is-invalid @enderror">
                            @error('appointment')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>


                        <div class="form-group" id="secure">
                            <label for="">Appointment Secure Check : </label>
                            <input  type="date" name="secure_check" value="{{$task->secure_check ? $task->secure_check :''}}" class="form-control @error('secure_check') is-invalid @enderror">
                            @error('secure_check')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>


                        <div class="form-group" id="status">
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
                <div class="text-center">
                    <input type="submit" class="btn btn-outline-dark col-5" value="Edit Task">

                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
<style type="text/css">
    #secure{
        display: none;
    }
    #status{
        display: none;
    }
</style>
