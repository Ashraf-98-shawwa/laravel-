@extends('cms.parent')
@section('title', 'Abouts')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('create about')
                    <a class="btn btn-primary mb-2" href="{{ route('abouts.create') }}">Create About</a>
            @endcan

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Abouts Table</h3>
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
                                <th>heading</th>
                                <th>paragraph 1</th>
                                <th>paragraph 2</th>
                                <th>paragraph 3</th>
                                <th>Signature Image</th>
                                @canAny('edit about', 'show about', 'delete about')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($abouts as $about)
                                <tr>
                                    <td>{{ $about->id }}</td>
                                    <td>
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('storage/images/about/' . $about->image) }}" width="60"
                                            height="60" alt="User Image">
                                    </td>
                                    <td>{{ $about->heading }}</td>

                                    <td>{{ $about->paragraph_1 }}</td>
                                    <td>{{ $about->paragraph_2 }}</td>
                                    <td>{{ $about->paragraph_3 }}</td>
                                    <td>
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('storage/images/about/' . $about->signature) }}" width="60"
                                            height="60" alt="User Image">
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @can('show about')
                                                <a href="{{ route('abouts.show', $about->id) }}"
                                                    class="btn btn-success">Show</a>
                                            @endcan
                                            @can('edit about')
                                                <a href=" {{ route('abouts.edit', $about->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete about')
                                                <button onclick="performDestroy({{ $about->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan
                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $abouts->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/abouts/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
