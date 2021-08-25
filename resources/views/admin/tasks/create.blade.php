@extends('admin.layouts.master')

@section('title')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Create {{$category->name}}</h1>
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
            @if($category->slug == "import-task")

               <form action="{{route('admin.tasks.store',$category->slug)}}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header"><b>{{ __('Create Task') }}</b></div>

                            <div class="card-body" id="import_form">
                                <div class="row">
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="">Name : </label>
                                            <input type="text" placeholder="Task Name" name="name" class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Shipping Date:</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" name="exit_time" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group" style="padding-top: 0px">
                                            <label for="">Users : </label>
                                            <select  name="user_id[]" id="category" class="form-control" multiple>
                                                @foreach($users as $user)
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
                                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-check" id="packing">
                                            <input  class="form-check-input" name="packing_list" value="1" type="checkbox" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Packing List
                                            </label>
                                        </div>

                                    </div>

                                    <div class="col-sm-6 ">

                                        <div class="form-group" id="select">
                                            <label for="">Charge Place : </label>
                                            <select name="place" id="place"  class="form-control" >
                                                @foreach($charge_place as $key=>$place)
                                                    <option  name="place" value="{{$place}}">{{$place}}</option>
                                                @endforeach
                                            </select>
                                            @error('place')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group" id="other">
                                            <label for="">Place : </label>
                                            <input type="text" placeholder="Other Place" name="place"  class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Arrive Time:</label>
                                            <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                                <input type="text" name="arrive_time" class="form-control datetimepicker-input" data-target="#reservationdate2"/>
                                                <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
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
                                            <label for="">Bill Of Loading : </label>
                                            <input type="text" placeholder="Bill Of Loading" name="policyId" class="form-control @error('policyId') is-invalid @enderror">
                                            @error('policyId')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-check" id="certificate">
                                            <input  class="form-check-input" name="created_certification" value="1" type="checkbox" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Certificate Of Origin(Euro)
                                            </label>
                                        </div>
                                        <br>
                                        <div class="form-check" id="invoice">
                                            <input  class="form-check-input" name="invoice" value="1" type="checkbox" id="flexCheckDefault">
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

                                        <div class="form-group" >
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
            @endif
            </div>
        </div>
    </div>

@endsection
<style type="text/css">
    #policy{
        display: none;
    }
    #certificate{
        display: none;
    }
    #invoice{
        display: none;
    }
    #packing{
        display: none;
    }
    #other{
        display: none;
    }
    /*#prev{*/
    /*    display: none;*/
    /*}*/
</style>
