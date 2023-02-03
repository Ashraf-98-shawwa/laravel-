@extends('cms.parent')
@section('title', 'Edit Article')


@section('styles')
@endsection

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Article</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="title">Article Title </label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}">

                </div>

                <div class="form-group">
                    <label for="paragraph_1">Paragraph one </label>
                    <textarea class="d-block w-100 border border-secondery" name="paragraph_1" id="paragraph_1" rows="10">{{ $article->paragraph_1 }}</textarea>
                </div>

                <div class="form-group">
                    <label for="paragraph_2 ">Paragraph two </label>
                    <textarea class="d-block w-100 border border-secondery" name="paragraph_2" id="paragraph_2" rows="10">{{ $article->paragraph_2 }}</textarea>
                </div>

                <div class="form-group">
                    <label for="paragraph_3">Paragraph three </label>
                    <textarea class="d-block w-100 border  border-secondery" name="paragraph_1" id="paragraph_3" rows="10">{{ $article->paragraph_3 }}</textarea>
                </div>

                <div class="form-group" data-select2-id="29">
                    <label>Author</label>
                    <select name="author_id" id="author_id" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option selected value="{{ $article->author_id }}" data-select2-id="3">
                            {{ $article->author->user->first_name . ' ' . $article->author->user->last_name }} </option>
                        @foreach ($authors as $author)
                            @if ($article->author_id != $author->id)
                                <option value="{{ $author->id }}" data-select2-id="3">
                                    {{ $author->user->first_name . ' ' . $author->user->last_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group" data-select2-id="29">
                    <label>Category</label>
                    <select name="category_id" id="category_id" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option selected value="{{ $article->category_id }}" data-select2-id="3">
                            {{ $article->category->name }} </option>
                        @foreach ($categories as $category)
                            @if ($article->category->name != $category->name)
                                <option value="{{ $category->id }}" data-select2-id="3">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="image">Article Image</label>
                    <input type="file" class="form-control" name="image" id="image"
                        placeholder="Enter Image of Article">
                </div>




            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performUpdate({{ $article->id  }})" class="btn btn-warning">Upate</button>
                <a class="btn btn-secondary" href="{{ route('articles.index') }}">Articles Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('title', document.getElementById('title').value);
            formData.append('paragraph_1', document.getElementById('paragraph_1').value);
            formData.append('paragraph_2', document.getElementById('paragraph_2').value);
            formData.append('paragraph_3', document.getElementById('paragraph_3').value);
            formData.append('category_id', document.getElementById('category_id').value);
            formData.append('author_id', document.getElementById('author_id').value);
            formData.append('image', document.getElementById('image').files[0]);
            storeRoute('/cms/admin/articles_update/' + id, formData);
        }
    </script>
@endsection
