@extends('cms.parent')
@section('title', 'Services')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('create service')
                <a class="btn btn-primary mb-2" href="{{ route('services.create') }}">Create Service</a>
            @endcan


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Services Table</h3>
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
                                <th>image</th>
                                <th>name</th>
                                <th>description</th>
                                <th>icon</th>
                                @canAny('edit service', 'show service', 'delete service')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr>
                                    <td>{{ $service->id }}</td>
                                    <td>
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('storage/images/service/' . $service->image) }}" width="60"
                                            height="60" alt="slider Image">
                                    </td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->description }}</td>
                                    <td>{{ $service->icon }}</td>

                                    <td>
                                        <div class="btn-group">
                                            @can('show service')
                                                <a href="{{ route('services.show', $service->id) }}"
                                                    class="btn btn-success">Show</a>
                                            @endcan
                                            @can('edit service')
                                                <a href=" {{ route('services.edit', $service->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete service')
                                                <button onclick="performDestroy({{ $service->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan
                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $services->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/services/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
