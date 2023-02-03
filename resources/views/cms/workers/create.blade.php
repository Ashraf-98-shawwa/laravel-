@extends('cms.parent')
@section('title', 'Create Worker')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Worker</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Worker Name </label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Enter Worker Name .. ">

                </div>
                <div class="form-group">
                    <label for="position">Worker Position </label>
                    <input type="text" class="form-control" id="position" name="position"
                        placeholder="Enter Worker position title .. ">

                </div>


                <div class="form-group">
                    <label for="twitter_link">Worker Link On Twitter </label>
                    <input type="text" class="form-control" id="twitter_link" name="twitter_link"
                        placeholder="Enter Worker Link on Twitter .. ">
                        <span>Put (#) If No Link</span>

                </div>
                <div class="form-group">
                    <label for="facebook_link">Worker Link On Facebook </label>
                    <input type="text" class="form-control" id="facebook_link" name="facebook_link"
                        placeholder="Enter Worker Link on twitter  .. ">
                        <span>Put (#) If No Link</span>

                </div>

                <div class="form-group">
                    <label for="linkedin_link">Worker Link On Linkedin </label>
                    <input type="text" class="form-control" id="linkedin_link" name="linkedin_link"
                        placeholder="Enter Worker Link on Linkedin .. ">
                        <span>Put (#) If No Link</span>

                </div>

                <div class="form-group">
                    <label for="instagram_link">Worker Link On Instagram </label>
                    <input type="text" class="form-control" id="instagram_link" name="instagram_link"
                        placeholder="Enter Worker Link  On Instagram .. ">
                        <span>Put (#) If No Link</span>

                </div>

                <div class="form-group">
                    <label for="youtube_link">Worker Link On Youtube </label>
                    <input type="text" class="form-control" id="youtube_link" name="youtube_link"
                        placeholder="Enter Worker Link  On Youtube .. ">
                        <span>Put (#) If No Link</span>

                </div>




                <div class="form-group col-md-12">
                    <label for="image">Worker Image</label>
                    <input type="file" class="form-control" name="image" id="image"
                        placeholder="Upload Worker Image">
                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="{{ route('workers.index') }}">Workers Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('position', document.getElementById('position').value);
            formData.append('twitter_link', document.getElementById('twitter_link').value);
            formData.append('facebook_link', document.getElementById('facebook_link').value);
            formData.append('linkedin_link', document.getElementById('linkedin_link').value);
            formData.append('instagram_link', document.getElementById('instagram_link').value);
            formData.append('youtube_link', document.getElementById('youtube_link').value);
            formData.append('image', document.getElementById('image').files[0]);

            storeRoute('/cms/admin/workers', formData);
        }
    </script>
@endsection
