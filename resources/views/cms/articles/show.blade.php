@extends('cms.parent')
@section('title', 'show project')


@section('styles')
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">show project</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="title">Article Title </label>
                    <input disabled type="text" class="form-control" id="title" name="title"
                        value="{{ $article->title }}">

                </div>

                <div>
                    <label class="d-block"> Article image</label>
                    <div class="w-50 mx-auto"> <img class=" img-bordered-sm ms-5"
                            src="{{ asset('storage/images/article/' . $article->image) }}" width="150" height="150"
                            alt="Article Image"></div>
                </div>
                <div class="form-group">
                    <label for="paragraph_1">Paragraph one </label>
                    <textarea disabled class="d-block w-100 border border-secondery" name="paragraph_1" id="paragraph_1" rows="10">{{ $article->paragraph_1 }}</textarea>
                </div>

                <div class="form-group">
                    <label for="paragraph_2 ">Paragraph two </label>
                    <textarea disabled class="d-block w-100 border border-secondery" name="paragraph_2" id="paragraph_2" rows="10">{{ $article->paragraph_2 }}</textarea>
                </div>

                <div class="form-group">
                    <label for="paragraph_3">Paragraph three </label>
                    <textarea disabled class="d-block w-100 border  border-secondery" name="paragraph_1" id="paragraph_3" rows="10">{{ $article->paragraph_3 }}</textarea>
                </div>



                <div>
                    <label for="author">Author </label>
                    <input disabled type="text" name="author" id="author"
                        value="{{ $article->author->user->first_name }}" class="form-control form-control-solid" />
                </div>


                <div class="form-group" data-select2-id="29">
                    <label>Category</label>
                    <select disabled name="category_id" id="category_id"
                        class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                        tabindex="-1" aria-hidden="true">
                        <option selected value="{{ $article->category_id }}" data-select2-id="3">
                            {{ $article->category->name }} </option>

                    </select>
                </div>





            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a class="btn btn-secondary" href="{{ route('articles.index') }}">Articles Table </a>
                <a class="btn btn-warning" href="{{ route('articles.edit', $article->id) }}">Edit Article </a>
            </div>
        </form>

        <!-- /.card-body -->


    </div>
@endsection

@section('scripts')

@endsection
