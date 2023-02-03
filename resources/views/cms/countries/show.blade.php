


@extends('cms.parent')
@section('title', 'show Country')


@section('styles')
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">show Country</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Country Name </label>
                    <input disabled type="text" class="form-control" id="name" name="name"
                        value="{{ $country->name }}">

                </div>

                <div class="form-group">
                    <label for="code">Country Code</label>
                    <input disabled type="text" class="form-control" id="code" name="code"
                        value="{{ $country->code }}">
                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a class="btn btn-warning" href="{{ route('countries.edit', $country->id) }}">Edit Country</a>
               
                <a class="btn btn-secondary" href="{{ route('countries.index') }}">Countries Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

@endsection
