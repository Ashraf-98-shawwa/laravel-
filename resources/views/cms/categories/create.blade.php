@extends('cms.parent')
@section('title', 'Create category')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Category Name </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category name .. "
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
                <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="{{ route('categories.index') }}">categories Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('image', document.getElementById('image').files[0]);


            storeRoute('/cms/admin/categories', formData);
        }
    </script>
@endsection
