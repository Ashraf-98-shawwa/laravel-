@extends('cms.parent')
@section('title', 'Show Contact')


@section('styles')
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Show Contact</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            <div class="row g-3 card-body">
                <div class="col-12 col-sm-6">
                    <label for="name"> Name </label>
                    <input disabled type="text" id="name" class="form-control bg-light border-0"
                        value="{{ $contact->name }}" style="height: 55px;">
                </div>
                <div class="col-12 col-sm-6">
                    <label for="email"> Email </label>

                    <input disabled type="email" class="form-control bg-light border-0" value="{{ $contact->email }}"
                        style="height: 55px;">
                </div>
                <div class="col-12 col-sm-6">
                    <label for="subject"> Subject </label>

                        <input id="subject" disabled type="text"
                            class="form-control bg-light border-0 datetimepicker-input" value="{{ $contact->subject }}"
                           style="height: 55px;">
                </div>

                <div class="col-12">
                    <label for="message"> Message </label>

                    <textarea id="message" name="message" disabled class="form-control bg-light border-0" rows="5">{{ $contact->message }}</textarea>
                </div>

            </div>
        </form>



        <div class="card-footer">
            <a class="btn btn-secondary" href="{{ route('contacts.index') }}">Contacts Table </a>
        </div>

        <!-- /.card-body -->


    </div>
@endsection

@section('scripts')

@endsection
