@extends('cms.parent')
@section('title', 'show Setting')


@section('styles')
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Show Setting</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

               <div class="card-body">
                <div class="form-group">
                    <label for="address">Address </label>
                    <input disabled type="text" class="form-control" id="address" name="address"
                       value="{{ $setting->address }}">

                </div>
                <div class="form-group">
                    <label for="email">Email </label>
                    <input disabled type="text" class="form-control" id="email" name="email"
                        value="{{ $setting->email }}">

                </div>
                <div class="form-group">
                    <label for="mobile">Mobile </label>
                    <input disabled type="text" class="form-control" id="mobile" name="mobile"
                         value="{{ $setting->mobile }}">

                </div>
                <div class="form-group">
                    <label for="twitter_link">Twitter link </label>
                    <input disabled type="text" class="form-control" id="twitter_link" name="twitter_link"
                         value="{{ $setting->twitter_link }}">

                </div>

                <div class="form-group">
                    <label for="facebook_link">Facebook link </label>
                    <input disabled type="text" class="form-control" id="facebook_link" name="facebook_link"
                         value="{{ $setting->facebook_link }}">

                </div>

                <div class="form-group">
                    <label for="linkedin_link">Linkedin link </label>
                    <input disabled type="text" class="form-control" id="linkedin_link" name="linkedin_link"
                        value="{{ $setting->linkedin_link}}">

                </div>

                <div class="form-group">
                    <label for="instagram_link">Instagram link </label>
                    <input disabled type="text" class="form-control" id="instagram_link" name="instagram_link"
                         value="{{ $setting->instagram_link}}">

                </div>
            </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a class="btn btn-warning" href="{{ route('settings.edit', $setting->id) }}">Edit setting</a>
                    <a class="btn btn-secondary" href="{{ route('settings.index') }}">Settings Table </a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

@endsection
