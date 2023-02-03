@extends('cms.parent')
@section('title', 'Show Slider')


@section('styles')
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Show Slider</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="heading">Heading </label>
                    <input disabled type="text" class="form-control" id="heading" name="heading"
                        value="{{ $slider->heading }}">

                </div>


                <div class="form-group col-md-6">
                    <label for="icon"> Icon</label>
                    <select disabled class="form-control" name="icon" style="width: 100%;" id="icon"
                        aria-label=".form-select-sm example">
                        <option selected value="{{ $slider->icon }}" data-select2-id="3">
                            {{ $slider->icon }}
                        </option>

                    </select>
                </div>

                <label class="d-block"> Slider image</label>
                <div class="w-50 mx-auto"> <img class=" img-bordered-sm ms-5"
                        src="{{ asset('storage/images/slider/' . $slider->image) }}" width="150" height="150"
                        alt="slider Image"></div>


                <!-- /.card-body -->

                <div class="card-footer">
                    <a class="btn btn-warning" href="{{ route('sliders.edit', $slider->id) }}">Edit Slider</a>
                    <a class="btn btn-secondary" href="{{ route('sliders.index') }}">Sliders Table </a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

@endsection
