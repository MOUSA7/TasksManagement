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
                                        <input type="text" name="name"  class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Date : </label>
                                        <input type="date" name="date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Time</label>
                                        <input type="time"  name="time" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Description :</label>
                                        <textarea name="description" class="form-control"></textarea>
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
