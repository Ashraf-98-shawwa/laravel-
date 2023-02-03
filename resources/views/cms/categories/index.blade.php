@extends('cms.parent')
@section('title', 'categories')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('create category')
                <a class="btn btn-primary mb-2" href="{{ route('categories.create') }}">Create Category</a>
            @endcan

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">categories Table</h3>
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
                                <th>Number of projects</th>
                                <th>Number of articles</th>
                                @canAny('edit category', 'show category', 'delete category')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('storage/images/category/' . $category->image) }}" width="60"
                                            height="60" alt="User Image">
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td> <span class="badge mt-3 bg-info">{{ $category->projects_count }}</span></td>
                                    <td><span class="badge mt-3 bg-info">{{ $category->articles_count }}</span></td>
                                    <td>
                                        <div class="btn-group">
                                            @can('show category')
                                                <a href="{{ route('categories.show', $category->id) }}"
                                                    class="btn btn-success">Show</a>
                                            @endcan
                                            @can('edit category')
                                                <a href=" {{ route('categories.edit', $category->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete category')
                                                <button onclick="performDestroy({{ $category->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan

                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>

                    {{ $categories->links() }}

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/categories/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
