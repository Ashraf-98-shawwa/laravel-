@extends('cms.parent')
@section('title', 'Edit Slider')


@section('styles')
@endsection

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Slider</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="heading">Heading </label>
                    <input type="text" class="form-control" id="heading" name="heading" value="{{ $slider->heading }}">

                </div>


                <div class="form-group col-md-6">
                    <label for="icon"> Icon</label>
                    <select class="form-control" name="icon" style="width: 100%;" id="icon"
                        aria-label=".form-select-sm example">
                        <option selected value="{{ $slider->icon }}" data-select2-id="3">
                            {{ $slider->icon }}
                        </option>

                        @if ($slider->icon != 'building')
                            <option value="building "> building </option>
                        @endif
                        @if ($slider->icon != 'drafting-compass')
                            <option value="drafting-compass"> drafting-compass </option>
                        @endif
                        @if ($slider->icon != 'palette')
                            <option value="palette"> palette </option>
                        @endif
                        @if ($slider->icon != 'home')
                            <option value="home"> home </option>
                        @endif
                        @if ($slider->icon != 'paint-brush')
                            <option value="paint-brush"> paint-brush </option>
                        @endif
                        @if ($slider->icon != 'tools')
                            <option value="tools"> tools </option>
                        @endif
                        @if ($slider->icon != 'hammer')
                            <option value="hammer"> hammer </option>
                        @endif
                        @if ($slider->icon != 'toolbox')
                            <option value="toolbox"> toolbox </option>
                        @endif
                        @if ($slider->icon != 'screwdriver')
                            <option value="screwdriver"> screwdriver </option>
                        @endif

                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image"
                        placeholder="Upload Slider Image">
                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button onclick="performUpdate({{ $slider->id }})" type="button" class="btn btn-warning">Update</button>
                <a class="btn btn-secondary" href="{{ route('sliders.index') }}">Sliders Table </a>

            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('heading', document.getElementById('heading').value);
            formData.append('icon', document.getElementById('icon').value);
            formData.append('image', document.getElementById('image').files[0]);
            storeRoute('/cms/admin/sliders_update/' + id, formData);
        }
    </script>
@endsection
