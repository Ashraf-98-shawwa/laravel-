@extends('cms.parent')
@section('title', 'Features')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('create feature')
                <a class="btn btn-primary mb-2" href="{{ route('features.create') }}">Create Feature</a>
            @endcan
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Features Table</h3>
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
                                <th>Feature name</th>
                                @canAny('edit about', 'show about', 'delete about')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($features as $feature)
                                <tr>
                                    <td>{{ $feature->id }}</td>
                                    <td>{{ $feature->name }}</td>

                                    <td>
                                        <div class="btn-group">
                                            @can('edit feature')
                                                <a href=" {{ route('features.edit', $feature->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete feature')
                                                <button onclick="performDestroy({{ $feature->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan


                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $features->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/features/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
