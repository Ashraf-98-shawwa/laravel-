@extends('cms.parent')
@section('title', 'show category')


@section('styles')
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">show category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Category Name </label>
                    <input disabled type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">

                </div>


                <label class="d-block"> Category image</label>
                <div class="w-50 mx-auto"> <img class=" img-bordered-sm ms-5"
                        src="{{ asset('storage/images/Category/' . $category->image) }}" width="150" height="150"
                        alt="User Image"></div>




            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="{{ route('categories.index') }}">categories Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

@endsection
