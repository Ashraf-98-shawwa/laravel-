@extends('cms.parent')
@section('title', 'Edit category')


@section('styles')
@endsection

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
          <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Category Name </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}"
                       >

                </div>


                <div class="form-group col-md-12">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image"
                        placeholder="Enter Image of category">
                </div>




            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performUpdate({{ $category->id }})" class="btn btn-warning">Update</button>
                <a class="btn btn-secondary" href="{{ route('categories.index') }}">categories Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('image', document.getElementById('image').files[0]);

            storeRoute('/cms/admin/categories_update/' + id, formData);
        }
    </script>
@endsection
