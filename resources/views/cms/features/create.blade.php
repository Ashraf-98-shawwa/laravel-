@extends('cms.parent')
@section('title', 'Create Feature')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Feature</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Feature name </label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Enter Feature Name .. ">

                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="{{ route('features.index') }}">Features Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);



            storeRoute('/cms/admin/features', formData);
        }
    </script>
@endsection
