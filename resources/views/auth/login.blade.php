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
    <div class="login-box">

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-bod border border-danger">
                <div class="login-logo text-danger  ">
                    <b style="font-size:50px;">{{ env('APP_NAME') }} </b>
                </div>
                <p class="login-box-msg font-weight-bold">Sign in as <span
                        class="text-danger text-capitalize ">{{ $guard }}</span> to start your session</p>

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
                    <div class="row mb-4">

                        <div class="col-4">
                            <button type="button" onclick="login()" class="btn btn-danger btn-block">Sign In</button>
                        </div>
                    </div>
                    @if ($guard == 'admin')
                        <a class="text-dark underline d-block" href="{{ route('view.login', 'author') }}"><u>sign in as
                                an
                                <span class="text-danger">Author</span></u> </a>
                    @endif
                    @if ($guard == 'author')
                        <a class="text-dark underline d-block" href="{{ route('view.login', 'admin') }}"><u>sign in as
                                an
                                <span class="text-danger">Admin</span></u> </a>
                    @endif


                </form>


                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a class="text-dark" href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="#" class="text-center text-dark">Register a new membership</a>
                </p>
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
        function login() {
            var guard = '{{ request('guard') }}';
            axios.post('/cms/' + guard + '/login', {
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    guard: guard
                })
                .then(function(response) {
                    window.location.href = '/cms/admin'
                })
                .catch(function(error) {
                    if (error.response.data.errors !== undefined) {
                        showErrorMessages(error.response.data.errors);

                    } else {
                        showMessage(error.response.data);
                    }
                });
        }
    </script>
</body>

</html>
