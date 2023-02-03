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
                    <label for="name">Worker Name </label>
                    <input disabled type="text" class="form-control" id="name" name="name" value="{{ $worker->name }}">

                </div>

                <div class="form-group">
                    <label for="position">Worker Position </label>
                    <input disabled type="text" class="form-control" id="position" name="position"
                        value="{{ $worker->position }}">

                </div>



                <div class="form-group">
                    <label for="twitter_link">Worker Link On Twitter </label>
                    <input disabled type="text" class="form-control" id="twitter_link" name="twitter_link"
                        value="{{ $worker->twitter_link }}">

                </div>
                <div class="form-group">
                    <label for="facebook_link">Worker Link On Facebook </label>
                    <input  disabled type="text" class="form-control" id="facebook_link" name="facebook_link"
                        value="{{ $worker->facebook_link }}">

                </div>

                <div class="form-group">
                    <label for="linkedin_link">Worker Link On Linkedin </label>
                    <input disabled type="text" class="form-control" id="linkedin_link" name="linkedin_link"
                        value="{{ $worker->linkedin_link }}">

                </div>

                <div class="form-group">
                    <label for="instagram_link">Worker Link On Instagram </label>
                    <input disabled type="text" class="form-control" id="instagram_link" name="instagram_link"
                        value="{{ $worker->instagram_link }}">

                </div>

                <div class="form-group">
                    <label for="youtube_link">Worker Link On Youtube </label>
                    <input disabled type="text" class="form-control" id="youtube_link" name="youtube_link"
                        value="{{ $worker->youtube_link }}">

                </div>

                <label class="d-block"> Worker image</label>
                <div class="w-50 mx-auto"> <img class=" img-bordered-sm ms-5"
                        src="{{ asset('storage/images/worker/' . $worker->image) }}" width="150" height="150"
                        alt="worker Image"></div>


                <!-- /.card-body -->

                <div class="card-footer">
                    <a class="btn btn-warning" href="{{ route('workers.edit', $worker->id) }}">Edit Worker</a>
                    <a class="btn btn-secondary" href="{{ route('workers.index') }}">Workers Table </a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

@endsection
