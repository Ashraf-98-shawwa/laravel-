@extends('cms.parent')
@section('title', 'Create Country')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Country</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Country Name </label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Enter Country name .. "  value="{{ old('name') }}">

                </div>

                <div class="form-group">
                    <label for="code">Country Code</label>
                    <input type="text" class="form-control" id="code" name="code"
                        placeholder="Enter Country Code .. " value="{{ old('code') }}">
                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="{{ route('countries.index') }}">Countries Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

<script>
    function performStore(){
        let formData = new FormData();
        formData.append('name' , document.getElementById('name').value);
        formData.append('code' , document.getElementById('code').value);

        storeRoute('/cms/admin/countries',formData);
    }
    </script>
@endsection
