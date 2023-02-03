@extends('website.parent')
@section('title', 'About')

@section('styles')
@endsection

@section('content')



    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">About</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a href="{{ route('home') }}">Home</a></h6>
            <h6 class="text-white m-0 px-3">/</h6>
            <h6 class="text-uppercase text-white m-0">About</h6>
        </div>
    </div>
    <!-- Page Header Start -->


    <!-- About Start -->
    <div class="container-fluid py-6 px-5">
        <div class="row g-5">
            <div class="col-lg-7">
                <h1 class="display-5 text-uppercase mb-4">{{ $about->heading }}</h1>
                <h4 class="text-uppercase mb-3 text-body">{{ $about->paragraph_1 }}</h4>
                <p>{{ $about->paragraph_2 }}</p>
                <div class="row gx-5 py-2">
                    <div class="col-sm-6 mb-2">
                        @foreach ( $features as $feature )
                        <p class="fw-bold mb-2"><i class="fa fa-check text-primary me-3"></i>{{ $feature->name }}</p>

                        @endforeach

                    </div>

                </div>
                <p class="mb-4">{{ $about->paragraph_3 }}</p>
                <img style="width:150px;height:100px;"  src="{{ asset('storage/images/about/' . $about->signature) }}" alt="">
            </div>
            <div class="col-lg-5 pb-5" style="min-height: 400px;">
                <div class="position-relative bg-dark-radial h-100 ms-5">
                    <img class="position-absolute w-100 h-100 mt-5 ms-n5" src="{{ asset('storage/images/about/' . $about->image) }}"
                        style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Appointment Start -->
    <div class="container-fluid bg-light py-6 px-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <div class="mb-4">
                    <h1 class="display-5 text-uppercase mb-4">Request A <span class="text-primary">Call Back</span></h1>
                </div>
                <p class="mb-5">Nonumy ipsum amet tempor takimata vero ea elitr. Diam diam ut et eos duo duo sed. Lorem
                    elitr sadipscing eos et ut et stet justo, sit dolore et voluptua labore. Ipsum erat et ea ipsum magna
                    sadipscing lorem. Sit lorem sea sanctus eos. Sanctus sit tempor dolores ipsum stet justo sit erat ea,
                    sed diam sanctus takimata sit. Et at voluptua amet erat justo amet ea ipsum eos, eirmod accusam sea sed
                    ipsum kasd ut.</p>
            </div>
            <div class="col-lg-8">
                <div class="bg-white text-center p-5">
                    <form>
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" id="name" name="name" class="form-control bg-light border-0"
                                    placeholder="Your Name" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input id="email" name="email" type="email" class="form-control bg-light border-0"
                                    placeholder="Your Email" style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" id="date1" name="date" type="text"
                                    class="form-control bg-light border-0 " placeholder="Call Back Date"
                                    style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" id="time1" name="time" class="form-control bg-light border-0 "
                                    placeholder="Call Back Time" style="height: 55px;">
                            </div>
                            <div class="col-12">
                                <textarea id="message" name="message" class="form-control bg-light border-0" rows="5" placeholder="Message"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" onclick="performStore()" type="button">Submit
                                    Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->

@endsection

@section('scripts')
    {{-- << needed when using ajax >> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('cms/js/crud.js') }}"></script>
    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('date', document.getElementById('date1').value);
            formData.append('time', document.getElementById('time1').value);
            formData.append('message', document.getElementById('message').value);

            store('/cms/admin/requests', formData);
        }


    </script>
@endsection
