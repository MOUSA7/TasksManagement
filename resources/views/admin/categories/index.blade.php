@extends('admin.layouts.master')

@section('title')
    <div class="row mb-2">

        <div class="col-sm-6">
            <h1>Tasks Categories</h1>
            <hr>

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Categories</li>
            </ol>
            <br>
            <br>
            <br>
            <a class="btn btn-outline-success float-right" data-toggle="modal" data-target="#create" >Create Category</a>
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
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="categories">
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>
                        <a href="{{route('admin.categories.show',$category->slug)}}">{{$category->name}}</a>
                    </td>
                    <td>{{$category->created_at->diffForHumans()}}</td>
                    <td>
                        <a class="btn btn-primary btn-xs fa fa-edit edit" data-id="{{$category->id}}"  ></a>
                        @if($category->tasks->count() >= 0)
                            <a href="{{route('admin.categories.show',$category->slug)}}" class="btn btn-info btn-xs fa fa-eye"></a>
                        @endif
                        <a  class="confirm btn btn-danger btn-xs fa fa-trash-alt"  data-id="{{$category->id}}"></a>

                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection



@section('modal')

    <!-- /.create-Category -->
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Create Category</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name"> Name :</label>
                            <input type="text" name="name" class="form-control" placeholder="Category name">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                        <button name="submit" type="button" id="save" class="btn btn-outline-success">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- /.create-Category -->
    <div id="editModal"></div>
    <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
    <input type="hidden"  name="_method" value="@method('DELETE')">

@stop
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $(document).ready(function(){
        $("#save").click(function(){
            var data = $("#form").serialize();
            $.post("categories/create",data).done(function (data) {
                $("#create").modal("hide");
                $("#categories").replaceWith(data);
            });
        });
        $(document).on('click','.edit',function () {
            var id = $(this).data("id");
            $.get("categories/"+id+"/edit").done(function (data) {
                $("#editModal").replaceWith(data);
                $("#editModal").modal('show');
            });

        });
        $(document).on('click','.save_edit',function () {
            var data = $("#edit_form").serialize();
            var id = $("#edit_form").data('id');

            $.post("categories/"+id,data).done(function (data) {
                // console.log(data)
                $("#categories").replaceWith(data);
                $("#editModal").modal('hide');
            });
        });

        $(document).on('click','.confirm',function () {

            var id = $(this).data('id');
            var token = $("#token").val();
            var method = $("#method").val();
            $.post("/admin/categories/delete/"+id,{'_method':method,"_token":token}).done(function (data) {
                $('#categories').replaceWith(data);
            })
        });
    });

</script>
