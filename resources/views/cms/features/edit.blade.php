@extends('cms.parent')
@section('title', 'Edit Feature')


@section('styles')
@endsection

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Feature</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Feature name </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $feature->name }}">

                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performUpdate({{ $feature->id  }})" class="btn btn-warning">Upate</button>
                <a class="btn btn-secondary" href="{{ route('features.index') }}">Features Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performUpdate(id) {
          let formData = new FormData();
            formData.append('name', document.getElementById('name').value);

            storeRoute('/cms/admin/features_update/' + id, formData);
        }
    </script>
@endsection
