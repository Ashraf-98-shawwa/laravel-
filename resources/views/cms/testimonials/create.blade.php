@extends('cms.parent')
@section('title', 'Create Testimonials')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Testimonial</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="client_name">Client Name </label>
                    <input type="text" class="form-control" id="client_name" name="client_name"
                        placeholder="Enter Client Name .. ">

                </div>

                <div class="form-group">
                    <label for="client_position">Client Position </label>
                    <input type="text" class="form-control" id="client_position" name="client_position"
                        placeholder="Enter Client Position .. ">

                </div>



                <div class="form-group">
                    <label for="client_testimonial">Client Testimonial </label>
                    <textarea class="d-block w-100 border  border-secondery" name="client_testimonial" id="client_testimonial"
                        rows="10"></textarea>
                </div>


                <div class="form-group col-md-12">
                    <label for="image">Client Image</label>
                    <input type="file" class="form-control" name="image" id="image"
                        placeholder="Upload Client Image">
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="{{ route('testimonials.index') }}">Testimonials Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('client_name', document.getElementById('client_name').value);
            formData.append('client_position', document.getElementById('client_position').value);
            formData.append('client_testimonial', document.getElementById('client_testimonial').value);
            formData.append('image', document.getElementById('image').files[0]);

            storeRoute('/cms/admin/testimonials', formData);
        }
    </script>
@endsection
