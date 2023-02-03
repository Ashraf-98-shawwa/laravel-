@extends('cms.parent')
@section('title', 'Create City')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create City</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">City Name </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter City name .. "
                        value="{{ old('name') }}">

                </div>

                <div class="form-group">
                    <label for="street">City street</label>
                    <input type="text" class="form-control" id="street" name="street"
                        placeholder="Enter City Code .. " value="{{ old('code') }}">
                </div>

                <div class="form-group" data-select2-id="29">
                    <label>Country</label>
                    <select name="country_id" id="country_id" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option selected value="" data-select2-id="3"> Select a country </option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" data-select2-id="3">{{ $country->name }}</option>
                        @endforeach
                    </select>


                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="{{ route('cities.index') }}">cities Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('street', document.getElementById('street').value);
            formData.append('country_id', document.getElementById('country_id').value);

            storeRoute('/cms/admin/cities', formData);
        }
    </script>
@endsection
