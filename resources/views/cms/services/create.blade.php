@extends('cms.parent')
@section('title', 'Create Service')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Service</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Service Name </label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Enter Service Name .. ">

                </div>

                <div class="form-group">
                    <label for="description">Service Description </label>
                    <textarea class="d-block w-100 border  border-secondery" name="description" placeholder="Write service description .."
                        id="description" rows="10"></textarea>
                </div>



                <div class="form-group col-md-6">
                    <label for="icon">Service Icon</label>
                    <select class="form-control" name="icon" style="width: 100%;" id="icon"
                        aria-label=".form-select-sm example">
                        <option value="building "> building </option>
                        <option value="drafting-compass"> drafting-compass </option>
                        <option value="palette"> palette </option>
                        <option value="home"> home </option>
                        <option value="paint-brush"> paint-brush </option>
                        <option value="tools"> tools </option>
                        <option value="hammer"> hammer </option>
                        <option value="toolbox"> toolbox </option>
                        <option value="screwdriver"> screwdriver </option>

                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="image">Service Image</label>
                    <input type="file" class="form-control" name="image" id="image"
                        placeholder="Upload Service Image">
                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="{{ route('services.index') }}">Services Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('description', document.getElementById('description').value);
            formData.append('icon', document.getElementById('icon').value);
            formData.append('image', document.getElementById('image').files[0]);

            storeRoute('/cms/admin/services', formData);
        }
    </script>
@endsection
