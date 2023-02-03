@extends('cms.parent')
@section('title', 'Create Project')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Project</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Project Name </label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Enter project name .. ">

                </div>
                <div class="form-group">
                    <label for="location">Project location </label>
                    <input type="text" class="form-control" id="location" name="location"
                        placeholder="Enter project location .. ">

                </div>

                <div class="form-group" data-select2-id="29">
                    <label>Category</label>
                    <select name="category_id" id="category_id" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option selected value="" data-select2-id="3"> Select a category </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" data-select2-id="3">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                    <div class="form-group col-md-12">
                        <label for="image">Project Image</label>
                        <input type="file" class="form-control" name="image" id="image"
                            placeholder="Enter Image of project">
                    </div>




                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
                    <a class="btn btn-secondary" href="{{ route('projects.index') }}">projects Table </a>
                </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('location', document.getElementById('location').value);
            formData.append('category_id', document.getElementById('category_id').value);
            formData.append('image', document.getElementById('image').files[0]);


            storeRoute('/cms/admin/projects', formData);
        }
    </script>
@endsection
