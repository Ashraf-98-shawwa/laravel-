@extends('cms.parent')
@section('title', 'Create Author')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Author</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                  <div class="form-group ">
                    <label for="role_id"> Role Name</label>
                    <select class="form-control" name="role_id" style="width: 100%;" id="role_id"
                        aria-label=".form-select-sm example">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Author email </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Author email "
                        >

                </div>

                <div class="form-group">
                    <label for="password">Author Password </label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter Author password " >

                </div>

                <div class="form-group">
                    <label for="first_name">First Name </label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                        placeholder="Enter Author first name " >

                </div>
                <div class="form-group">
                    <label for="last_name">Last Name </label>
                    <input type="text" class="form-control" id="last_name" name="last_name"
                        placeholder="Enter Author last name " >

                </div>
                <div class="form-group">
                    <label for="mobile"> Mobile </label>
                    <input type="text" class="form-control" id="mobile" name="mobile"
                        placeholder="Enter Author mobile "">

                </div>
                <div class="form-group">
                    <label for="date"> date of birth </label>
                    <input type="date" class="form-control" id="date" name="date"
                        placeholder="Enter Author date of birth " >

                </div>
                <div class="form-group">
                    <label for="address"> address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        placeholder="Enter Author address " >

                </div>

                <div class="form-group col-md-6">
                    <label for="city_id"> City Name</label>
                    <select class="form-control" name="city_id" style="width: 100%;" id="city_id"
                        aria-label=".form-select-sm example">
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="gender"> Gender</label>
                    <select class="form-control" name="gender" style="width: 100%;" id="gender"
                        aria-label=".form-select-sm example">
                        <option value="male "> Male </option>
                        <option value="female"> Female </option>

                    </select>
                </div>


                <div class="form-group col-md-12">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image"
                        placeholder="Enter Image of Author">
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="{{ route('authors.index') }}">Authors Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('password', document.getElementById('password').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('first_name', document.getElementById('first_name').value);
            formData.append('last_name', document.getElementById('last_name').value);
            formData.append('mobile', document.getElementById('mobile').value);
            formData.append('date', document.getElementById('date').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('gender', document.getElementById('gender').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('city_id', document.getElementById('city_id').value);
            formData.append('role_id', document.getElementById('role_id').value);

            storeRoute('/cms/admin/authors', formData);
        }
    </script>
@endsection
