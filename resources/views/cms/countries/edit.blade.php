@extends('cms.parent')
@section('title', 'Edit Country')


@section('styles')
@endsection

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit Country</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('countries.update', $country->id) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Country Name </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $country->name }}">
                </div>
                <div class="form-group">
                    <label for="code">Country Code</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{ $country->code }}">
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button onclick="performUpdate({{ $country->id }})" type="button" class="btn btn-warning">Update</button>
                <a class="btn btn-secondary" href="{{ route('countries.index') }}">Countries Table </a>

            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('code', document.getElementById('code').value);
            storeRoute('/cms/admin/countries_update/' + id, formData);
        }
    </script>
@endsection
