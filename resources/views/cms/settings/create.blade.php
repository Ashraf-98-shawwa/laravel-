@extends('cms.parent')
@section('title', 'Create Setting')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Setting</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="address">Address </label>
                    <input type="text" class="form-control" id="address" name="address"
                        placeholder="Enter Company Address .. ">

                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="text" class="form-control" id="email" name="email"
                        placeholder="Enter Company Email .. ">

                </div>
                <div class="form-group">
                    <label for="mobile">Mobile </label>
                    <input type="text" class="form-control" id="mobile" name="mobile"
                        placeholder="Enter Company Mobile .. ">

                </div>
                <div class="form-group">
                    <label for="twitter_link">Twitter link </label>
                    <input type="text" class="form-control" id="twitter_link" name="twitter_link"
                        placeholder="Enter Company Link On Twitter.. ">
                    <span>Put (#) If No Link</span>


                </div>

                <div class="form-group">
                    <label for="facebook_link">Facebook link </label>
                    <input type="text" class="form-control" id="facebook_link" name="facebook_link"
                        placeholder="Enter Company Link On Facebook.. ">
                    <span>Put (#) If No Link</span>


                </div>

                <div class="form-group">
                    <label for="linkedin_link">Linkedin link </label>
                    <input type="text" class="form-control" id="linkedin_link" name="linkedin_link"
                        placeholder="Enter Company Link On Linkedin.. ">
                    <span>Put (#) If No Link</span>


                </div>

                <div class="form-group">
                    <label for="instagram_link">Instagram link </label>
                    <input type="text" class="form-control" id="instagram_link" name="instagram_link"
                        placeholder="Enter Company Link On Instagram.. ">
                    <span>Put (#) If No Link</span>


                </div>



            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="{{ route('settings.index') }}">Settings Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('address', document.getElementById('address').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('mobile', document.getElementById('mobile').value);
            formData.append('twitter_link', document.getElementById('twitter_link').value);
            formData.append('facebook_link', document.getElementById('facebook_link').value);
            formData.append('linkedin_link', document.getElementById('linkedin_link').value);
            formData.append('instagram_link', document.getElementById('instagram_link').value);

            storeRoute('/cms/admin/settings', formData);
        }
    </script>
@endsection
