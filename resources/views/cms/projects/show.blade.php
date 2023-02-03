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
                    <label for="name">Project Name </label>
                    <input disabled type="text" class="form-control" id="name" name="name"
                        value="{{ $Project->name }}">

                </div>

                <div class="form-group">
                    <label for="location">Project location </label>
                    <input disabled type="text" class="form-control" id="location" name="location"
                        value="{{ $Project->location }}">

                </div>

                <div class="form-group">

                    <label class="d-block"> Project image</label>
                    <div class="w-50 mx-auto"> <img class=" img-bordered-sm ms-5"
                            src="{{ asset('storage/images/Project/' . $Project->image) }}" width="150" height="150"
                            alt="UserImage"></div>



                </div>


                <div class="form-group" data-select2-id="29">
                    <label>Category</label>
                    <select disabled name="category_id" id="category_id"
                        class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1"
                        tabindex="-1" aria-hidden="true">
                        <option selected value="{{ $Project->category_id }}" data-select2-id="3">
                            {{ $Project->category->name }}

                    </select>


                </div>
            </div>
             <div class="card-footer">
          <a class="btn btn-warning" href="{{ route('projects.edit', $Project->id )}}">Edit Project </a>
          <a class="btn btn-secondary" href="{{ route('projects.index') }}">projects Table </a>
         </div>
    </div>
    </form>

    <!-- /.card-body -->


    </div>
@endsection

@section('scripts')

@endsection
