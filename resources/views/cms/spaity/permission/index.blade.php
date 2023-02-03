@extends('cms.parent')

@section('title', 'Permission')

@section('main-title', 'Index Permissions')

@section('sub-title', 'index Permissions')


@section('styles')

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    @can('Create Permission')
                        <a href="{{ route('permissions.create') }}" class="btn btn-primary">Create Permission</a>
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
                                <th> Permission Name</th>
                                @canAny('Show Permission', 'Edit Permission', 'Delete Permission')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td><span class="badge bg-success">{{ $permission->guard_name }}</span></td>

                                    <td>{{ $permission->name }}</td>

                                    <td>
                                        <div class="btn-group">
                                            @can('Edit Permission')
                                                <a href="{{ route('permissions.edit', $permission->id) }}" type="button"
                                                    class="btn btn-info">Edit</a>
                                            @endcan
                                            @can('Delete Permission')
                                                <a href="#" onclick="performDestroy({{ $permission->id }} , this)"
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
                {{ $permissions->links() }}
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/permissions/' + id;
            confirmDestroy(url, referance);
        }
    </script>
@endsection
