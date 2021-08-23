@extends('admin.layouts.master')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Import Task</h1>
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
            <div class="col-md-6">
                @if($task->Send_to_sincere != null ||$task->secure_check != null || $task->appointment != null)
                    <div class="card" id="result">
                        <div class="card-body">
                            @if($task->Send_to_sincere)

                                <div>
                                    <p>Do you Sent Document To Broker : <span class="badge badge-primary col-6">Document Sent To Broker Successfully</span>
                                    </p>
                                </div>
                            @endif

                            @if($task->secure_check)
                                <div id="secure">
                                    <p>Appointment Secure Check&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="badge badge-primary col-4">{{$task->secure_check}}</span></p>

                                </div>
                            @endif


                            @if($task->appointment)
                                <div>
                                    <p>Coordination Into Gaza &nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;:&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; <span
                                            class="badge badge-primary col-4">{{$task->appointment}}</span></p>

                                </div>
                            @endif



                            @if($task->status)
                                <div>
                                    <p>Status &nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                                        <span class="badge badge-primary col-4">{{$task->status}}</span></p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                @if($task->Send_to_sincere == null ||$task->secure_check == null || $task->appointment == null || $task->status == 0)
                    <form action="{{route('admin.tasks.editor.update',$task->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header text-center">{{ __('Import Task') }}</div>

                            <div class="card-body">
                                @if($task->Send_to_sincere == null)
                                    <div class="form-check" id="send">
                                        <input class="form-check-input" name="Send_to_sincere" type="checkbox" value="1"
                                               id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Do you Send to Broker
                                        </label>
                                    </div>
                                @endif

                                @if($task->secure_check == null  && $task->Send_to_sincere != null)
                                        <div class="form-group">
                                            <label>Security Checking:</label>
                                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                <input type="text" name="secure_check" class="form-control datetimepicker-input" data-target="#reservationdatetime"/>
                                                <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                @endif

                                @if($task->appointment == null && $task->Send_to_sincere != null && $task->secure_check != null)
                                    <div class="form-group" id="appoint">
                                        <label for="">Appointment Coordination to Gaza : </label>
                                        <input id="date" type="date"
                                               value="{{$task->appointment ? $task->appointment :''}}"
                                               name="appointment"
                                               class="form-control @error('appointment') is-invalid @enderror">
                                        @error('appointment')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                @endif
                                @if($task->status == null && $task->Send_to_sincere != null && $task->secure_check != null && $task->appointment != null)

                                    <div class="form-group">
                                        <label for="">Status : </label>
                                        <select name="status" class="form-control">
                                            @foreach($status as $key=>$state)
                                                <option value="{{$state}}">{{$state}}</option>
                                                {{--                                                <option value="{{$key}}">{{$state}}</option>--}}
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" id="save" class="btn btn-outline-dark col-5" value="Save">
                            <a href="{{route('admin.categories.show',$task->category->slug)}}"
                               class="btn btn-outline-info col-5">Cancel</a>
                        </div>
                    </form>
                @endif
                @if($task->Send_to_sincere != null && $task->secure_check != null && $task->appointment != null  &&  $task->status != 0 || $task->status !=null)
                    <div class="text-center">
                        <a href="{{route('admin.categories.show',$task->category->slug)}}" class="btn btn-info col-5">Finish</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
<script>
</script>
<style type="text/css">
    /*#appoint{*/
    /*    display: none;*/
    /*}*/
    /*#secure{*/
    /*    display: none;*/
    /*}*/
    /*#result{*/
    /*    display: none;*/
    /*}*/
</style>
