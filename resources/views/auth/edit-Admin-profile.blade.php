

  @extends('cms.parent')
    @section('title', 'Edit Admin Profile ')


    @section('styles')
    @endsection

    @section('content')
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Edit Admin Profile</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
                @csrf

                <div class="card-body">

                    <div class="form-group">
                        <label for="email">Admin email </label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $admin->email }}">

                    </div>



                    <div class="form-group">
                        <label for="first_name">First Name </label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                            value="{{ $admin->user->first_name }}">

                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name </label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                            value="{{ $admin->user->last_name }}">

                    </div>
                    <div class="form-group">
                        <label for="mobile"> Mobile </label>
                        <input type="text" class="form-control" id="mobile" name="mobile"
                            value="{{ $admin->user->mobile }}">

                    </div>
                    <div class="form-group">
                        <label for="date"> date of birth </label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ $admin->user->date }}">

                    </div>
                    <div class="form-group">
                        <label for="address"> address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ $admin->user->address }}">

                    </div>

                    <div class="form-group col-md-6">
                        <label for="city_id"> City Name</label>
                        <select class="form-control" name="city_id" style="width: 100%;" id="city_id"
                            aria-label=".form-select-sm example">
                            <option selected value="{{ $admin->user->city_id }}" data-select2-id="3">
                                {{ $admin->user->city->name }}
                            </option>
                            @foreach ($cities as $city)
                                @if ($city->name != $admin->user->city->name)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="gender"> Gender</label>
                        <select class="form-control" name="gender" style="width: 100%;" id="gender"
                            aria-label=".form-select-sm example">

                            <option selected value="{{ $admin->user->gender }}" data-select2-id="3">
                                {{ $admin->user->gender }}
                            </option>
                            @if ($admin->user->gender == 'male')
                                <option value="female"> Female </option>
                            @else
                                <option value="male "> Male </option>
                            @endif

                        </select>
                    </div>


                    <div class="form-group col-md-12">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image"
                            placeholder="Enter Image of Admin">
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button onclick="performUpdateAdmin()" type="button"
                        class="btn btn-warning">Update</button>
                    <a class="btn btn-secondary" href="{{ route('admins.index') }}">admins Table </a>
                </div>
            </form>
        </div>
    @endsection

    @section('scripts')

        <script>
            function performUpdateAdmin() {
                let formData = new FormData();
                formData.append('email', document.getElementById('email').value);
                formData.append('first_name', document.getElementById('first_name').value);
                formData.append('last_name', document.getElementById('last_name').value);
                formData.append('mobile', document.getElementById('mobile').value);
                formData.append('date', document.getElementById('date').value);
                formData.append('address', document.getElementById('address').value);
                formData.append('gender', document.getElementById('gender').value);
                formData.append('image', document.getElementById('image').files[0]);
                formData.append('city_id', document.getElementById('city_id').value);
                storeRoute('/cms/admin/Profile/update', formData);
            }
        </script>
    @endsection

