<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit_form"  data-id="{{$category->id}}">
                @csrf
                @method('PUT')
                {{--                    <input type="hidden" id="categoryId" value="{{$category->id}}">--}}
                <div class="modal-header">
{{--                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>--}}
                    <h4 class="modal-title">Update Category</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name"> Name :</label>
                        <input type="text" name="name" class="form-control" value="{{$category->name}}">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                    <button name="submit" type="button"  class="save_edit btn btn-outline-success">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
