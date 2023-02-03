@extends('cms.parent')
@section('title', 'Requests')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Requests Table</h3>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Message</th>
                                @canAny('show request', 'delete request')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                                <tr>
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $request->name }}</td>
                                    <td>{{ $request->email }}</td>
                                    <td>{{ $request->date }}</td>
                                    <td>{{ $request->time }}</td>
                                    <td>{{ $request->message }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @can('show request')
                                                <a href="{{ route('requests.show', $request->id) }}"
                                                    class="btn btn-success">Show</a>
                                            @endcan
                                            @can('delete request')
                                                <button onclick="performDestroy({{ $request->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan
                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $requests->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/requests/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
