@extends('cms.parent')
@section('title', 'Edit Worker')


@section('styles')
@endsection

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Worker</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Worker Name </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $worker->name }}">

                </div>

                <div class="form-group">
                    <label for="position">Worker Position </label>
                    <input type="text" class="form-control" id="position" name="position"
                        value="{{ $worker->position }}">

                </div>



                <div class="form-group">
                    <label for="twitter_link">Worker Link On Twitter </label>
                    <input type="text" class="form-control" id="twitter_link" name="twitter_link"
                        value="{{ $worker->twitter_link }}">

                </div>
                <div class="form-group">
                    <label for="facebook_link">Worker Link On Facebook </label>
                    <input type="text" class="form-control" id="facebook_link" name="facebook_link"
                        value="{{ $worker->facebook_link }}">

                </div>

                <div class="form-group">
                    <label for="linkedin_link">Worker Link On Linkedin </label>
                    <input type="text" class="form-control" id="linkedin_link" name="linkedin_link"
                        value="{{ $worker->linkedin_link }}">

                </div>

                <div class="form-group">
                    <label for="instagram_link">Worker Link On Instagram </label>
                    <input type="text" class="form-control" id="instagram_link" name="instagram_link"
                        value="{{ $worker->instagram_link }}">

                </div>

                <div class="form-group">
                    <label for="youtube_link">Worker Link On Youtube </label>
                    <input type="text" class="form-control" id="youtube_link" name="youtube_link"
                        value="{{ $worker->youtube_link }}">

                </div>

                <div class="form-group col-md-12">
                    <label for="image">Service Image</label>
                    <input type="file" class="form-control" name="image" id="image"
                        placeholder="Upload Service Image">
                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button onclick="performUpdate({{ $worker->id }})" type="button" class="btn btn-warning">Update</button>
                <a class="btn btn-secondary" href="{{ route('workers.index') }}">Workers Table </a>

            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('position', document.getElementById('position').value);
            formData.append('twitter_link', document.getElementById('twitter_link').value);
            formData.append('facebook_link', document.getElementById('facebook_link').value);
            formData.append('linkedin_link', document.getElementById('linkedin_link').value);
            formData.append('instagram_link', document.getElementById('instagram_link').value);
            formData.append('youtube_link', document.getElementById('youtube_link').value);
            formData.append('image', document.getElementById('image').files[0]);

            storeRoute('/cms/admin/workers_update/' + id, formData);
        }
    </script>
@endsection
