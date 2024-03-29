@extends('cms.parent')

@section('title', 'Role')

@section('main-title', 'Create Role')

@section('sub-title', 'create role')


@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Role</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            @csrf

                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="guard_name"> Guard Name </label>
                                        <select class="form-control" name="guard_name" style="width: 100%;" id="guard_name"
                                            aria-label=".form-select-sm example">
                                            <option value="admin">Admin</option>
                                            <option value="author">Author</option>
                                               <option value="admin-api">Admin-api</option>
                                            <option value="author-api">Author-api</option>
                                            {{-- <option value="web">User</option> --}}
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">Role Name</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Enter Name of Role">
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    @can('Create Role')
                                        <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
                                    @endcan
                                    @can('Index Roles')
                                        <a href="{{ route('roles.index') }}" type="submit" class="btn btn-secondary">Go To
                                            Index</a>
                                    @endcan

                                </div>
                        </form>
                    </div>

                </div>
                <!--/.col (left) -->
                <!-- right column -->

                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')

    <script>
        function performStore() {

            let formData = new FormData();
            formData.append('guard_name', document.getElementById('guard_name').value);
            formData.append('name', document.getElementById('name').value);
            store('/cms/admin/roles', formData);

        }
    </script>
@endsection
