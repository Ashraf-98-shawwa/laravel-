@extends('cms.parent')
@section('title', 'projects')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('create project')
                <a class="btn btn-primary mb-2" href="{{ route('projects.create') }}">Create project</a>
            @endcan

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">projects Table</h3>
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
                                <th>location</th>
                                <th>category</th>
                                @canAny('edit project', 'show project', 'delete project')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('storage/images/project/' . $project->image) }}" width="60"
                                            height="60" alt="User Image">
                                    </td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->location }}</td>
                                    <td><span
                                            class="badge mt-3 bg-info">{{ $project->category ? $project->category->name : 'null' }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @can('show project')
                                                <a href="{{ route('projects.show', $project->id) }}"
                                                    class="btn btn-success">Show</a>
                                            @endcan
                                            @can('edit project')
                                                <a href=" {{ route('projects.edit', $project->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete project')
                                                <button onclick="performDestroy({{ $project->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan
                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $projects->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/projects/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
