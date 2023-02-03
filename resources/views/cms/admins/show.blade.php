@extends('cms.parent')
@section('title', 'Show Admin')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Show Admin</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">

                <label class="d-block"> Admin image</label>
                <div class="w-50 mx-auto"> <img class="img-circle img-bordered-sm ms-5"
                        src="{{ asset('storage/images/admin/' . $admin->user->image) }}" width="150" height="150"
                        alt="User Image"></div>

                <div class="form-group">
                    <label for="email">Admin email </label>
                    <input disabled type="email" class="form-control" id="email" name="email"
                        value="{{ $admin->email }}">

                </div>


                <div class="form-group">
                    <label for="first_name">First Name </label>
                    <input disabled type="text" class="form-control" id="first_name" name="first_name"
                        value="{{ $admin->user->first_name }}">

                </div>
                <div class="form-group">
                    <label for="last_name">Last Name </label>
                    <input disabled type="text" class="form-control" id="last_name" name="last_name"
                        value="{{ $admin->user->last_name }}">

                </div>
                <div class="form-group">
                    <label for="mobile"> Mobile </label>
                    <input disabled type="text" class="form-control" id="mobile" name="mobile"
                        value="{{ $admin->user->mobile }}">

                </div>
                <div class="form-group">
                    <label for="date"> date of birth </label>
                    <input type="date" class="form-control" id="date" name="date"
                        value="{{ $admin->user->date }}" disabled>

                </div>
                <div class="form-group">
                    <label for="address"> address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ $admin->user->address }}" disabled>

                </div>

                <div class="form-group col-md-6">
                    <label for="city_id"> City Name</label>
                    <select disabled class="form-control" name="city_id" style="width: 100%;" id="city_id"
                        aria-label=".form-select-sm example">
                        <option value="{{ $admin->user->city_id }}">{{ $admin->user->city->name }}</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="gender"> Gender</label>
                    <select disabled class="form-control" name="gender" style="width: 100%;" id="gender"
                        aria-label=".form-select-sm example">
                        <option value="{{ $admin->user->gender }}">{{ $admin->user->gender }}</option>

                    </select>
                </div>




            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a class="btn btn-secondary" href="{{ route('admins.index') }}">Admins Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
    @endsection
