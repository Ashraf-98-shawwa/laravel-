@extends('cms.parent')
@section('title', 'Authors')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('Create Author')
                <a class="btn btn-primary mb-2" href="{{ route('authors.create') }}">Create Author</a>
            @endcan


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Authors Table</h3>
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
                                <th>First name</th>
                                <th>last name</th>
                                <th>Articles/count</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                @canAny('Show Author', 'Edit Author', 'Delete Author')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @auth('admin')
                                @foreach ($authors as $author)
                                    <tr>
                                        <td>{{ $author->id }}</td>
                                        <td>
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ asset('storage/images/author/' . $author->user ?$author->user->image : 'no value') }}"
                                                width="60" height="60" alt="User Image">
                                        </td>
                                        <td>{{ $author->user->first_name }}</td>
                                        <td>{{ $author->user->last_name }}</td>
                                        <td><a href="{{ route('indexArticle', ['id' => $author->id]) }}"
                                                class="btn btn-info">({{ $author->articles_count }})
                                                article/s</a> </td>
                                        <td>{{ $author->user->mobile }}</td>
                                        <td>{{ $author->email }}</td>
                                        <td>
                                            <div class="btn-group">
                                                @can('Show Author')
                                                    <a href="{{ route('authors.show', $author->id) }}"
                                                        class="btn btn-success">Show</a>
                                                @endcan
                                                @can('Edit Author')
                                                    <a href=" {{ route('authors.edit', $author->id) }}"
                                                        class="btn btn-warning">Edit</a>
                                                @endcan

                                                @can('Delete Author')
                                                    <button onclick="performDestroy({{ $author->id }} , this)" type="button"
                                                        class="btn btn-danger">Delete</button>
                                                @endcan

                                            </div>

                                        </td>

                                    </tr>
                                @endforeach
                            @endauth

                            @auth('author')
                                <tr>
                                    <td>{{ $author->id }}</td>
                                    <td>
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('storage/images/author/' . $author->user->image) }}" width="60"
                                            height="60" alt="User Image">
                                    </td>
                                    <td>{{ $author->user->first_name }}</td>
                                    <td>{{ $author->user->last_name }}</td>
                                    <td><a href="{{ route('indexArticle', ['id' => $author->id]) }}"
                                            class="btn btn-info">({{ $author->articles_count }})
                                            article/s</a> </td>
                                    <td>{{ $author->user->mobile }}</td>
                                    <td>{{ $author->email }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @can('Show Author')
                                                <a href="{{ route('authors.show', $author->id) }}" class="btn btn-success">Show</a>
                                            @endcan
                                            @can('Edit Author')
                                                <a href=" {{ route('authors.edit', $author->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan

                                            @can('Delete Author')
                                                <button onclick="performDestroy({{ $author->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan

                                        </div>

                                    </td>

                                </tr>
                            @endauth


                        </tbody>
                    </table>

                    @auth('admin')
                    {{ $authors->links() }}

                    @endauth

                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/authors/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
