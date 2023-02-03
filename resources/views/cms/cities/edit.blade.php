@extends('cms.parent')
@section('title', 'Edit city')


@section('styles')
@endsection

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit city</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('cities.update', $city->id) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">city Name </label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $city->name }}">
                </div>
                <div class="form-group">
                    <label for="street">city street</label>
                    <input type="text" class="form-control" id="street" name="street" value="{{ $city->street }}">
                </div>

                <div class="form-group" data-select2-id="29">
                    <label>Country</label>
                    <select name="country_id" id="country_id" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option selected value="{{ $city->country_id }}" data-select2-id="3">{{ $city->country->name }}
                        </option>
                        @foreach ($countries as $country)
                            @if ($country->name != $city->country->name)
                                <option value="{{ $country->id }}" data-select2-id="3">{{ $country->name }}</option>
                            @endif
                        @endforeach
                    </select>


                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button onclick="performUpdate({{ $city->id }})" type="button" class="btn btn-warning">Update</button>
                <a class="btn btn-secondary" href="{{ route('cities.index') }}">cities Table </a>

            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('street', document.getElementById('street').value);
            formData.append('country_id', document.getElementById('country_id').value);
            storeRoute('/cms/admin/cities_update/' + id, formData);
        }
    </script>
@endsection
