@extends('cms.parent')
@section('title', 'cities')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('create city')
                <a class="btn btn-primary mb-2" href="{{ route('cities.create') }}">Create city</a>
            @endcan

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">cities Table</h3>
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
                                <th>city Name</th>
                                <th>city street</th>
                                <th>country</th>
                         @canAny('edit city', 'show city', 'delete city')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                                <tr>
                                    <td>{{ $city->id }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->street }}</td>
                                    <td><span class="badge bg-info">{{ $city->country->name }}</span></td>
                                    <td>
                                        <div class="btn-group"> @can('show city')
                                                <a href="{{ route('cities.show', $city->id) }}" class="btn btn-success">Show</a>
                                            @endcan
                                            @can('edit city')
                                                <a href=" {{ route('cities.edit', $city->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete city')
                                                <button onclick="performDestroy({{ $city->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan
                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $cities->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/cities/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
