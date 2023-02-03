@extends('cms.parent')
@section('title', 'Countries')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('create country')
                <a class="btn btn-primary mb-2" href="{{ route('countries.create') }}">Create Country</a>
            @endcan


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Countries Table</h3>
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
                                <th>Country Name</th>
                                <th>Country Code</th>
                                <th>Number of cities</th>
                                @canAny('edit country', 'show country', 'delete country')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($countries as $country)
                                <tr>
                                    <td>{{ $country->id }}</td>
                                    <td>{{ $country->name }}</td>
                                    <td>{{ $country->code }}</td>
                                    <td><span class="badge  bg-info">{{ $country->cities_count }}</span></td>
                                    <td>
                                        <div class="btn-group">
                                            @can('show country')
                                                <a href="{{ route('countries.show', $country->id) }}"
                                                    class="btn btn-success">Show</a>
                                            @endcan
                                            @can('edit country')
                                                <a href=" {{ route('countries.edit', $country->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete country')
                                                <button onclick="performDestroy({{ $country->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan
                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $countries->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/countries/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
