@extends('cms.parent')
@section('title', 'Subscripers')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Subscripers Table</h3>
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
                                <th>Email</th>
                                @can('delete subscriper')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscripers as $subscriper)
                                <tr>
                                    <td>{{ $subscriper->id }}</td>
                                    <td>{{ $subscriper->email }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @can('delete subscriper')
                                                <button onclick="performDestroy({{ $subscriper->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan

                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $subscripers->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/subscripers/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
