@extends('admin.layouts.master')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Tasks Management</h1>
            <br>
            <a href="{{ URL::previous() }}" class="btn btn-default" style="margin-top: -8px;"> <i class="fa fa-arrow-left"></i> Go Back</a>
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">


                <form action="{{route('admin.tasks.editor.update',$task->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header text-center">{{ __('Import Task') }}</div>
                        <input type="hidden" name="editor" value="1">
                        <div class="card-body">
                                <div class="form-check" id="send">
                                    <input class="form-check-input" name="Send_to_sincere" type="checkbox" value="1"
                                           id="flexCheckDefault" {{$task->Send_to_sincere == 1?'checked':0}}>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Send Document
                                    </label>
                                </div>

                                    <div class="form-group">
                                        <label>Security Checking:</label>
                                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                            <input type="text" name="secure_check" value="{{$task->secure_check}}" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                        <!--Driver Israel!-->
                                <div class="form-check" >
                                    <input class="form-check-input" name="driver_israel" type="checkbox" value="1"
                                           id="flexCheckDefault" {{$task->driver_israel == 1?'checked':0}}>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Driver israel
                                    </label>
                                </div>

                        <!--Driver Appointment Coordination!-->
                                <div class="form-group">
                                    <label>Appointment Coordination to Gaza :</label>
                                    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                        <input type="text" name="appointment" value="{{$task->appointment}}" class="form-control datetimepicker-input" data-target="#reservationdate2"/>
                                        <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check" id="send">
                                    <input class="form-check-input" name="driver_gaza" type="checkbox" value="1"
                                           id="flexCheckDefault" {{$task->driver_gaza == 1?'checked':0}}>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Driver Gaza
                                    </label>
                                </div>


                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" id="save" class="btn btn-outline-dark col-5" value="Save">
                        <a href="{{route('admin.categories.show',$task->category->slug)}}"
                           class="btn btn-outline-info col-5">Cancel</a>
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
