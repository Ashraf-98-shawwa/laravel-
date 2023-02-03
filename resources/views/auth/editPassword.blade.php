@extends('cms.parent')
@section('title', 'Resest Password')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Resest Password</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label id="click" for="password">Old Password </label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter Old Password .. ">

                </div>
                <div class="form-group">
                    <label for="new_password">New Password </label>
                    <input type="password" class="form-control" id="new_password" name="new_password"
                        placeholder="Enter New Password .. ">

                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password </label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation"
                        placeholder="Re Write New Password .. ">
                    <div style="display: none" id="error" class="text-red text-bold px-3"> Password does not match
                    </div>
                    <div style="display: none" id="match" class="text-success text-bold px-3"> Confirmed passwords
                    </div>

                </div>





            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performResetPassword()" class="btn btn-primary">Reset Password</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performResetPassword() {
            let formData = new FormData();
            formData.append('password', document.getElementById('password').value);
            formData.append('new_password', document.getElementById('new_password').value);
            formData.append('new_password_confirmation', document.getElementById('new_password_confirmation').value);

            storeRoute('/cms/admin/Password/update', formData);
        }


        let Newpassword = document.getElementById('new_password');
        let Confirmationpassword = document.getElementById('new_password_confirmation');



        let connfirmationMessage = document.getElementById('match');
        let ErrorMessage = document.getElementById('error');

        Newpassword.oninput = _ => {

            if (Newpassword.value == Confirmationpassword.value) {
                connfirmationMessage.style.display = "block";
                ErrorMessage.style.display = "none";
            }
            else if(Newpassword.value != Confirmationpassword.value) {
                connfirmationMessage.style.display = "none";
                ErrorMessage.style.display = "block";
            }

        }

        Confirmationpassword.oninput = _ => {

            if (Newpassword.value == Confirmationpassword.value) {
                connfirmationMessage.style.display= "block";
                ErrorMessage.style.display = "none";

            }
            else if(Newpassword.value != Confirmationpassword.value) {
                connfirmationMessage.style.display = "none";
                ErrorMessage.style.display = "block";
            }
        }
    </script>
@endsection
