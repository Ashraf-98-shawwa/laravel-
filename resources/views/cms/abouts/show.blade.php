@extends('cms.parent')
@section('title', 'show About')


@section('styles')
@endsection

@section('content')
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Show About</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="heading">About Heading</label>
                    <input disabled type="text" class="form-control" id="heading" name="heading"
                        value="{{ $about->heading }}">

                </div>


                <div>
                    <label class="d-block"> About image</label>
                    <div class="w-50 mx-auto"> <img class=" img-bordered-sm ms-5"
                            src="{{ asset('storage/images/about/' . $about->image) }}" width="150" height="150"
                            alt="About Image"></div>
                </div>

                <div class="form-group">
                    <label for="paragraph_1">Paragraph one </label>
                    <textarea disabled class="d-block w-100 border border-secondery" name="paragraph_1" id="paragraph_1" rows="10">{{ $about->paragraph_1 }}</textarea>
                </div>

                <div class="form-group">
                    <label for="paragraph_2 ">Paragraph two </label>
                    <textarea disabled class="d-block w-100 border border-secondery" name="paragraph_2" id="paragraph_2" rows="10">{{ $about->paragraph_2 }}</textarea>
                </div>

                <div class="form-group">
                    <label for="paragraph_3">Paragraph three </label>
                    <textarea disabled class="d-block w-100 border  border-secondery" name="paragraph_1" id="paragraph_3" rows="10">{{ $about->paragraph_3 }}</textarea>
                </div>


                <div>
                    <label class="d-block"> Signature Image</label>
                    <div class="w-50 mx-auto"> <img class=" img-bordered-sm ms-5"
                            src="{{ asset('storage/images/about/' . $about->signature) }}" width="150" height="150"
                            alt="Signature Image"></div>
                </div>



            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a class="btn btn-secondary" href="{{ route('abouts.index') }}">About Table </a>
                <a class="btn btn-warning" href="{{ route('abouts.edit', $about->id) }}">Edit About </a>
            </div>
        </form>

        <!-- /.card-body -->


    </div>
@endsection

@section('scripts')

@endsection
