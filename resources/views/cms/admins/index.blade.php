@extends('cms.parent')
@section('title', 'Admins')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('Create Admin')
                <a class="btn btn-primary mb-2" href="{{ route('admins.create') }}">Create Admin</a>
            @endcan

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Admins Table</h3>
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
                <div class="card-body table-responsive p-2">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>First name</th>
                                <th>last name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                @canAny('Show Adminr', 'Edit Admin', 'Delete Admin')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td>
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('storage/images/admin/' . $admin->user->image) }}" width="60"
                                            height="60" alt="User Image">
                                    </td>
                                    <td>{{ $admin->user->first_name }}</td>
                                    <td>{{ $admin->user->last_name }}</td>
                                    <td>{{ $admin->user->mobile }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @can('Show Admin')
                                                <a href="{{ route('admins.show', $admin->id) }}"
                                                    class="btn btn-success">Show</a>
                                            @endcan
                                            {{-- @can('Edit Admin')
                                                <a href=" {{ route('admins.edit', $admin->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan --}}
                                            @can('Delete Admin')
                                                <button onclick="performDestroy({{ $admin->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan
                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $admins->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/admins/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
