@extends('cms.parent')
@section('title', 'Create About')


@section('styles')
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create About</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form>
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="heading">About heading </label>
                    <input type="text" class="form-control" id="heading" name="heading"
                        placeholder="Enter About heading .. ">

                </div>

                <div class="form-group">
                    <label for="paragraph_1">Paragraph one </label>
                    <textarea class="d-block w-100 border border-secondery" name="paragraph_1" placeholder="Write paragraph one .." id="paragraph_1" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="paragraph_2 ">Paragraph two </label>
                    <textarea class="d-block w-100 border border-secondery"  name="paragraph_2" placeholder="Write paragraph two .." id="paragraph_2" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="paragraph_3">Paragraph three </label>
                    <textarea class="d-block w-100 border  border-secondery"  name="paragraph_1" placeholder="Write paragraph three .." id="paragraph_3" rows="10"></textarea>
                </div>


                <div class="form-group col-md-12">
                    <label for="image">About Image</label>
                    <input type="file" class="form-control" name="image" id="image"
                        placeholder="Enter Image of Article">
                </div>

                <div class="form-group col-md-12">
                    <label for="signature">Signature Image</label>
                    <input type="file" class="form-control" name="signature" id="signature"
                        placeholder="Enter Image of signature">
                </div>




            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Create</button>
                <a class="btn btn-secondary" href="{{ route('abouts.index') }}">Abouts Table </a>
            </div>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('heading', document.getElementById('heading').value);
            formData.append('paragraph_1', document.getElementById('paragraph_1').value);
            formData.append('paragraph_2', document.getElementById('paragraph_2').value);
            formData.append('paragraph_3', document.getElementById('paragraph_3').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('signature', document.getElementById('signature').files[0]);


            storeRoute('/cms/admin/abouts', formData);
        }
    </script>
@endsection
