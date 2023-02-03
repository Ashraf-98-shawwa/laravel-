@extends('cms.parent')
@section('title', 'Articles')


@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @can('create article')
                <a class="btn btn-primary mb-2" href="{{ route('articles.create') }}">Create Article</a>
            @endcan


            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">articles Table</h3>
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
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>paragraph 1</th>
                                <th>paragraph 2</th>
                                <th>paragraph 3</th>
                                <th>Number of Comments</th>
                                @canAny('edit article', 'show article', 'delete article')
                                    <th>operations</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td>{{ $article->id }}</td>
                                    <td>
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('storage/images/article/' . $article->image) }}" width="60"
                                            height="60" alt="User Image">
                                    </td>
                                    <td>{{ $article->title }}</td>
                                    <td><span
                                            class="badge mt-3 bg-info">{{ $article->category ? $article->category->name : 'null' }}</span>
                                    </td>
                                    <td><span
                                            class="badge mt-3 bg-info">{{ $article->author ? $article->author->user->first_name : 'null' }}</span>
                                    </td>
                                    <td>{{ $article->paragraph_1 }}</td>
                                    <td>{{ $article->paragraph_2 }}</td>
                                    <td>{{ $article->paragraph_3 }}</td>
                                    <td><span class="badge bg-info">{{ $article->comments_count }}</span></td>
                                    <td>
                                        <div class="btn-group">
                                            @can('show article')
                                                <a href="{{ route('articles.show', $article->id) }}"
                                                    class="btn btn-success">Show</a>
                                            @endcan
                                            @can('edit article')
                                                <a href=" {{ route('articles.edit', $article->id) }}"
                                                    class="btn btn-warning">Edit</a>
                                            @endcan
                                            @can('delete article')
                                                <button onclick="performDestroy({{ $article->id }} , this)" type="button"
                                                    class="btn btn-danger">Delete</button>
                                            @endcan
                                        </div>

                                    </td>

                                </tr>
                            @endforeach


                        </tbody>
                    </table>


                </div>
                {{ $articles->links() }}

            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        function performDestroy(id, referance) {
            let url = '/cms/admin/articles/' + id
            confirmDestroy(url, referance)
            console.log(referance)
        }
    </script>
@endsection
