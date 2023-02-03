@extends('cms.parent')
@section('title', 'Create Article')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Article</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="title">Article Title </label>
                    <input type="text" class="form-control" id="title" name="title"
                        placeholder="Enter Article title .. ">

                </div>

                <div class="form-group">
                    <label for="paragraph_1">Paragraph one </label>
                    <textarea class="d-block w-100 border border-secondery" name="paragraph_1" placeholder="Write paragraph one .." id="paragraph_1" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="paragraph_2 ">Paragraph two </label>
                    <textarea class="d-block w-100 border border-secondery"  name="paragraph_2" placeholder="Write paragraph two .." id="paragraph_2" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="paragraph_3">Paragraph three </label>
                    <textarea class="d-block w-100 border  border-secondery"  name="paragraph_1" placeholder="Write paragraph three .." id="paragraph_3" rows="10"></textarea>
                </div>

                  <input type="text" name="author_id" id="author_id" value="{{$id}}"
                    class="form-control form-control-solid" hidden/>

                <div class="form-group" data-select2-id="29">
                    <label>Category</label>
                    <select name="category_id" id="category_id" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option selected value="" data-select2-id="3"> Select a category </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" data-select2-id="3">{{ $category->name }}</option>
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
                <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="{{ route('articles.index') }}">Articles Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('title', document.getElementById('title').value);
            formData.append('paragraph_1', document.getElementById('paragraph_1').value);
            formData.append('paragraph_2', document.getElementById('paragraph_2').value);
            formData.append('paragraph_3', document.getElementById('paragraph_3').value);
            formData.append('category_id', document.getElementById('category_id').value);
            formData.append('author_id', document.getElementById('author_id').value);
            formData.append('image', document.getElementById('image').files[0]);


            storeRoute('/cms/admin/articles', formData);
        }
    </script>
@endsection
