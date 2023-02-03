@extends('cms.parent')
@section('title', 'Edit Project')


@section('styles')
@endsection

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Project</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Project Name </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $Project->name }}">

                </div>
                <div class="form-group">
                    <label for="location">Project location </label>
                    <input type="text" class="form-control" id="location" name="location"
                        value="{{ $Project->location }}">

                </div>

                    <div class="form-group" data-select2-id="29">
                    <label>Category</label>
                    <select name="category_id" id="category_id" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option selected value="{{ $Project->category_id }}" data-select2-id="3">{{ $Project->category->name }}
                        </option>
                        @foreach ($categories as $category)
                            @if ($category->name != $Project->category->name)
                                <option value="{{ $category->id }}" data-select2-id="3">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>


                </div>

                <div class="form-group col-md-12">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image"
                        placeholder="Enter Image of Project">
                </div>




            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performUpdate({{ $Project->id }})" class="btn btn-warning">Update</button>
                <a class="btn btn-secondary" href="{{ route('projects.index') }}">Projects Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('location', document.getElementById('location').value);
            formData.append('category_id', document.getElementById('category_id').value);
            formData.append('image', document.getElementById('image').files[0]);

            storeRoute('/cms/admin/projects_update/' + id, formData);
        }
    </script>
@endsection
