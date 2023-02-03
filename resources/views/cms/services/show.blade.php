@extends('cms.parent')
@section('title', 'Show Service')


@section('styles')
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Show Service</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Service Name </label>
                    <input disabled type="text" class="form-control" id="name" name="name"
                        value="{{ $service->name }}">

                </div>


                <div class="form-group">
                    <label for="description">Service Description </label>
                    <textarea disabled class="d-block w-100 border  border-secondery" name="description"
                        id="paragraph_3" rows="10">{{ $service->description }}</textarea>
                </div>

                <div class="form-group col-md-6">
                    <label for="icon">Service Icon</label>
                    <select disabled class="form-control" name="icon" style="width: 100%;" id="icon"
                        aria-label=".form-select-sm example">
                        <option selected value="{{ $service->icon }}" data-select2-id="3">
                            {{ $service->icon }}
                        </option>

                    </select>
                </div>

                <label class="d-block"> Service image</label>
                <div class="w-50 mx-auto"> <img class=" img-bordered-sm ms-5"
                        src="{{ asset('storage/images/service/' . $service->image) }}" width="150" height="150"
                        alt="slider Image"></div>


                <!-- /.card-body -->

                <div class="card-footer">
                    <a class="btn btn-warning" href="{{ route('services.edit', $service->id) }}">Edit Service</a>
                    <a class="btn btn-secondary" href="{{ route('services.index') }}">Services Table </a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

@endsection
