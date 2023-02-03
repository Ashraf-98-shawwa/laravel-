@extends('cms.parent')

@section('title', 'Roles')

@section('main-title', 'Index Roles')

@section('sub-title', 'index Roles')


@section('styles')

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @can('Create Role')
                        <a href="{{ route('roles.create') }}" type="submit" class="btn btn-primary">Create Role</a>
                    @endcan

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Guard Name</th>
                                <th> Role Name</th>
                                <th> Role Permissions</th>
                                @canany('Edit Role', 'Delete Role')

                                    <th>Setting</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td><span class="badge bg-success">{{ $role->guard_name }}</span></td>

                                    <td>{{ $role->name }}</td>

                                    <td><a href="{{ route('roles.permissions.index', $role->id) }}"
                                            class="btn btn-info">({{ $role->permissions_count }})
                                            permissions/s</a>
                                    </td>


                                    <td>
                                        <div class="btn-group">
                                            @can('Edit Role')
                                                <a href="{{ route('roles.edit', $role->id) }}" type="button"
                                                    class="btn btn-info">Edit</a>
                                            @endcan
                                            @can('Delete Role')
                                                <a href="#" onclick="performDestroy({{ $role->id }} , this)"
                                                    class="btn btn-danger">Delete</a>
                                            @endcan

                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                {{ $roles->links() }}
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/roles/' + id;
            confirmDestroy(url, referance);
        }
    </script>
@endsection
