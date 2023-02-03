@extends('cms.parent')
@section('title', 'Show Request')


@section('styles')
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Show Request</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            <div class="row g-3 card-body">
                <div class="col-12 col-sm-6">
                    <label for="name"> Name </label>
                    <input disabled type="text" id="name" class="form-control bg-light border-0"
                        value="{{ $request->name }}" style="height: 55px;">
                </div>
                <div class="col-12 col-sm-6">
                    <label for="email"> Email </label>

                    <input disabled type="email" class="form-control bg-light border-0" value="{{ $request->email }}"
                        style="height: 55px;">
                </div>
                <div class="col-12 col-sm-6">
                    <label for="date"> Date </label>

                    <div class="date" id="date" data-target-input="nearest">

                        <input id="date" disabled type="text"
                            class="form-control bg-light border-0 datetimepicker-input" value="{{ $request->date }}"
                            data-target="#date" data-toggle="datetimepicker" style="height: 55px;">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <label for="time"> Time </label>

                    <div class="time" id="time" name="time" data-target-input="nearest">
                        <input disabled type="text" class="form-control bg-light border-0 datetimepicker-input"
                            value="{{ $request->time }}" data-target="#time" data-toggle="datetimepicker"
                            style="height: 55px;">
                    </div>
                </div>
                <div class="col-12">
                    <label for="message"> Message </label>

                    <textarea id="message" name="message" disabled class="form-control bg-light border-0" rows="5">{{ $request->message }}</textarea>
                </div>

            </div>
        </form>



        <div class="card-footer">
            <a class="btn btn-secondary" href="{{ route('requests.index') }}">Requests Table </a>
        </div>

        <!-- /.card-body -->


    </div>
@endsection

@section('scripts')

@endsection
