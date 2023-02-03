@extends('cms.parent')
@section('title', 'show city')


@section('styles')
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">show city</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">city Name </label>
                    <input disabled type="text" class="form-control" id="name" name="name"
                        value="{{ $city->name }}">

                </div>

                <div class="form-group">
                    <label for="street">city street</label>
                    <input disabled type="text" class="form-control" id="street" name="street"
                        value="{{ $city->street }}">
                </div>

                <div class="form-group" data-select2-id="29">
                    <label>Country</label>
                    <select disabled name="country_id" id="country_id" class="form-control select2 select2-hidden-accessible"
                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option selected value="{{ $city->country_id }}" data-select2-id="3">{{ $city->country->name }}
                        </option>

                    </select>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <a class="btn btn-warning" href="{{ route('cities.edit', $city->id) }}">Edit city</a>
                    <a class="btn btn-secondary" href="{{ route('cities.index') }}">cities Table </a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

@endsection
