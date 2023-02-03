<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body class="hold-transition login-page bg-light">
    <div class="login-box w-50">

        <!-- /.login-logo -->
        <div class="card w-100">
            <div class="card-body login-card-bod border border-danger">
                <div class="login-logo text-danger  ">
                    <b style="font-size:50px;">{{ env('APP_NAME') }} </b>
                </div>
                <p class="login-box-msg font-weight-bold">Sign up</p>

                <form>
                    <div class="input-group  mb-3">
                        <input type="email" class="form-control border border-danger" placeholder="Email"
                            id="email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text  border border-danger">
                                <span class="fas fa-envelope text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control  border border-danger" placeholder="Password"
                            id="password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text  border border-danger">
                                <span class="fas fa-lock text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group row row-cols-3 mb-3">
                        <div class="form-group">
                            <label for="first_name">First Name </label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="Enter Author first name ">

                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name </label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Enter Author last name ">

                        </div>
                         <div class="form-group">
                            <label for="mobile"> Mobile </label>
                            <input type="text" class="form-control" id="mobile" name="mobile"
                                placeholder="Enter Author mobile "">

                        </div>
                         <div class="form-group">
                            <label for="date"> date of birth </label>
                            <input type="date" class="form-control" id="date" name="date"
                                placeholder="Enter Author date of birth ">

                        </div>
                        <div class="form-group">
                            <label for="address"> address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Enter Author address ">

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
                          <div class="col-4">
                            <button type="button" onclick="performStore()" class="btn btn-danger btn-block">Sign
                                Up</button>
                        </div>
                    </div>

                </form>


                <!-- /.social-auth-links -->


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('cms/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('cms/dist/js/adminlte.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{ asset('cms/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('cms/js/crud.js') }}"></script>

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
            formData.append('role_id', '2');

            storeRoute('/cms/admin/authors', formData);
        }
    </script>
</body>

</html>
