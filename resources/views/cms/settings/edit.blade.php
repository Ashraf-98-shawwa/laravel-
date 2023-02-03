@extends('cms.parent')
@section('title', 'Edit Settings')


@section('styles')
@endsection

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Setting</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="address">Address </label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $setting->address }}">

                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $setting->email }}">

                </div>
                <div class="form-group">
                    <label for="mobile">Mobile </label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $setting->mobile }}">

                </div>
                <div class="form-group">
                    <label for="twitter_link">Twitter link </label>
                    <input type="text" class="form-control" id="twitter_link" name="twitter_link"
                        value="{{ $setting->twitter_link }}">
                    <span>Put (#) If No Link</span>


                </div>

                <div class="form-group">
                    <label for="facebook_link">Facebook link </label>
                    <input type="text" class="form-control" id="facebook_link" name="facebook_link"
                        value="{{ $setting->facebook_link }}">
                    <span>Put (#) If No Link</span>


                </div>

                <div class="form-group">
                    <label for="linkedin_link">Linkedin link </label>
                    <input type="text" class="form-control" id="linkedin_link" name="linkedin_link"
                        value="{{ $setting->linkedin_link }}">
                    <span>Put (#) If No Link</span>


                </div>

                <div class="form-group">
                    <label for="instagram_link">Instagram link </label>
                    <input type="text" class="form-control" id="instagram_link" name="instagram_link"
                        value="{{ $setting->instagram_link }}">
                    <span>Put (#) If No Link</span>


                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button onclick="performUpdate({{ $setting->id }})" type="button" class="btn btn-warning">Update</button>
                <a class="btn btn-secondary" href="{{ route('settings.index') }}">Settings Table </a>

            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('address', document.getElementById('address').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('mobile', document.getElementById('mobile').value);
            formData.append('twitter_link', document.getElementById('twitter_link').value);
            formData.append('facebook_link', document.getElementById('facebook_link').value);
            formData.append('linkedin_link', document.getElementById('linkedin_link').value);
            formData.append('instagram_link', document.getElementById('instagram_link').value);
            storeRoute('/cms/admin/settings_update/' + id, formData);
        }
    </script>
@endsection
