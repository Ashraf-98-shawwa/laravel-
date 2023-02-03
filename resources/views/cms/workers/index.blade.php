@extends('cms.parent')
@section('title', 'Workers')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('create worker')
                <a class="btn btn-primary mb-2" href="{{ route('workers.create') }}">Create Worker</a>
            @endcan

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Workers Table</h3>
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
                                <th>position</th>
                                <th>Twitter link</th>
                                <th>Facebook link</th>
                                <th>Youtube link</th>
                                <th>Instagram link</th>
                                <th>Linkedin link</th>
                                @canAny('edit worker', 'show worker', 'delete worker')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($workers as $worker)
                                <tr>
                                    <td>{{ $worker->id }}</td>
                                    <td>
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('storage/images/worker/' . $worker->image) }}" width="60"
                                            height="60" alt="worker Image">
                                    </td>
                                    <td>{{ $worker->name }}</td>
                                    <td>{{ $worker->position }}</td>
                                    <td>{{ $worker->twitter_link }}</td>
                                    <td>{{ $worker->facebook_link }}</td>
                                    <td>{{ $worker->linkedin_link }}</td>
                                    <td>{{ $worker->instagram_link }}</td>

                                    <td>
                                        <div class="btn-group">
                                            @can('show worker')
                                                <a href="{{ route('workers.show', $worker->id) }}"
                                                    class="btn btn-success">Show</a>
                                            @endcan

                                            @can('edit worker')
                                                <a href=" {{ route('workers.edit', $worker->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan

                                            @can('delete worker')
                                                <button onclick="performDestroy({{ $worker->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan

                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $workers->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/workers/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
