@extends('cms.parent')
@section('title', 'show Feature')


@section('styles')
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Show Feature</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Feature Name</label>
                    <input disabled type="text" class="form-control" id="name" name="name"
                        value="{{ $feature->name }}">

                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a class="btn btn-secondary" href="{{ route('features.index') }}">Features Table </a>
                <a class="btn btn-warning" href="{{ route('features.edit', $feature->id) }}">Edit Feature </a>
            </div>
        </form>

        <!-- /.card-body -->


    </div>
@endsection

@section('scripts')

@endsection
