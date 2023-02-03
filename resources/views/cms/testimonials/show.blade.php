@extends('cms.parent')
@section('title', 'Show Testimonial')


@section('styles')
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Show Testimonial</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                  <div class="form-group">
                    <label for="client_name">Client Name </label>
                    <input disabled type="text" class="form-control" id="client_name" name="client_name"
                        value="{{ $testimonial->client_name }}">

                </div>

                <div class="form-group">
                    <label for="client_position">Client Position </label>
                    <input disabled type="text" class="form-control" id="client_position" name="client_position"
                        value="{{ $testimonial->client_position }}">

                </div>

                <div class="form-group">
                    <label for="client_testimonial">Client Testimonial</label>
                    <textarea disabled class="d-block w-100 border  border-secondery" name="client_testimonial" id="client_testimonial"
                        rows="10">{{ $testimonial->client_testimonial }}</textarea>
                </div>


                <label class="d-block"> Client Image</label>
                <div class="w-50 mx-auto"> <img class=" img-bordered-sm ms-5"
                        src="{{ asset('storage/images/testimonial/' . $testimonial->image) }}" width="150" height="150"
                        alt="slider Image"></div>


                <!-- /.card-body -->

                <div class="card-footer">
                    <a class="btn btn-warning" href="{{ route('testimonials.edit', $testimonial->id) }}">Edit Testimonial</a>
                    <a class="btn btn-secondary" href="{{ route('testimonials.index') }}">Testimonials Table </a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

@endsection
