@extends('cms.parent')
@section('title', 'Edit Service')


@section('styles')
@endsection

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Service</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Service Name </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $service->name }}">

                </div>

                <div class="form-group">
                    <label for="description">Service Description </label>
                    <textarea class="d-block w-100 border  border-secondery" name="description"
                        id="description" rows="10">{{ $service->description }}</textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="icon">Service Icon</label>
                    <select class="form-control" name="icon" style="width: 100%;" id="icon"
                        aria-label=".form-select-sm example">
                        <option selected value="{{ $service->icon }}" data-select2-id="3">
                            {{ $service->icon }}
                        </option>

                        @if ($service->icon != 'building')
                            <option value="building "> building </option>
                        @endif
                        @if ($service->icon != 'drafting-compass')
                            <option value="drafting-compass"> drafting-compass </option>
                        @endif
                        @if ($service->icon != 'palette')
                            <option value="palette"> palette </option>
                        @endif
                        @if ($service->icon != 'home')
                            <option value="home"> home </option>
                        @endif
                        @if ($service->icon != 'paint-brush')
                            <option value="paint-brush"> paint-brush </option>
                        @endif
                        @if ($service->icon != 'tools')
                            <option value="tools"> tools </option>
                        @endif
                        @if ($service->icon != 'hammer')
                            <option value="hammer"> hammer </option>
                        @endif
                        @if ($service->icon != 'toolbox')
                            <option value="toolbox"> toolbox </option>
                        @endif
                        @if ($service->icon != 'screwdriver')
                            <option value="screwdriver"> screwdriver </option>
                        @endif

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
                <button onclick="performUpdate({{ $service->id }})" type="button" class="btn btn-warning">Update</button>
                <a class="btn btn-secondary" href="{{ route('services.index') }}">Services Table </a>

            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performUpdate(id) {
            let formData = new FormData();
             formData.append('name', document.getElementById('name').value);
            formData.append('description', document.getElementById('description').value);
            formData.append('icon', document.getElementById('icon').value);
            formData.append('image', document.getElementById('image').files[0]);

            storeRoute('/cms/admin/services_update/' + id, formData);
        }
    </script>
@endsection
